import os
import re

def process():
    views_dir = 'views'
    exclude = ['security.php', 'support.php', 'splash.php']
    
    for filename in os.listdir(views_dir):
        if not filename.endswith('.php') or filename in exclude:
            continue
            
        filepath = os.path.join(views_dir, filename)
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
            
        # 1. Update the view tag
        view_pattern = r'(<(?:section|div)\s+id="view-[^"]+"\s+class="view[^"]*")'
        if 'overflow-y: hidden' not in content:
            content = re.sub(view_pattern, r'\1 style="overflow-y: hidden; display: flex; flex-direction: column;"', content)
        
        # 2. Find the header and add flex-shrink: 0;
        # Headers can be class="header-simple", "home-header", "profile-header"
        header_match = re.search(r'(<div\s+class="(?:header-simple|home-header|profile-header|home-header)[^>]*>)', content)
        if not header_match:
            print(f"No header found in {filename}")
            continue
            
        header_str = header_match.group(1)
        if 'style="' in header_str:
            if 'flex-shrink: 0' not in header_str:
                new_header_str = header_str.replace('style="', 'style="flex-shrink: 0; ')
                content = content.replace(header_str, new_header_str)
        else:
            # add style attribute
            new_header_str = header_str.replace('>', ' style="flex-shrink: 0;">')
            content = content.replace(header_str, new_header_str)
            
        # 3. We need to wrap the rest of the content.
        # This is tricky because we need to find the END of the header div.
        # Let's find the header start index.
        start_idx = content.find(new_header_str if 'flex-shrink: 0' in content else header_str)
        
        # Find the matching closing </div> for the header
        div_level = 0
        end_header_idx = -1
        in_tag = False
        i = start_idx
        while i < len(content):
            if content[i:i+4] == '<div':
                div_level += 1
                i += 4
                continue
            elif content[i:i+6] == '</div>':
                div_level -= 1
                if div_level == 0:
                    end_header_idx = i + 6
                    break
                i += 6
                continue
            i += 1
            
        if end_header_idx == -1:
            print(f"Could not find closing div for header in {filename}")
            continue
            
        # 4. Insert the wrapper right after the header
        wrapper_start = '\n    <!-- Scrollable Content -->\n    <div class="scroll-wrapper" style="flex: 1; overflow-y: auto; overscroll-behavior-y: contain; padding-bottom: 30px;">'
        
        # Ensure we haven't already wrapped it
        if 'class="scroll-wrapper"' in content:
            print(f"Already wrapped {filename}")
            continue
            
        content = content[:end_header_idx] + wrapper_start + content[end_header_idx:]
        
        # 5. Insert closing </div> before the closing </section> or </div> of the view
        # The view closes at the end of the file. Usually the last </section> or </div>
        # We will find the last </section> or </div>
        close_section_idx = content.rfind('</section>')
        if close_section_idx == -1:
            close_section_idx = content.rfind('</div>')
            
        if close_section_idx != -1:
            content = content[:close_section_idx] + '    </div>\n' + content[close_section_idx:]
        
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f"Processed {filename}")

if __name__ == '__main__':
    process()
