import os
import re

def process():
    views_dir = 'views'
    
    for filename in os.listdir(views_dir):
        if not filename.endswith('.php'):
            continue
            
        filepath = os.path.join(views_dir, filename)
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
            
        # Remove the inline style
        old_style = ' style="overflow-y: hidden; display: flex; flex-direction: column;"'
        if old_style in content:
            content = content.replace(old_style, ' class="flex-view-fixed"')
            
        # We also need to fix the class attribute since we just added a new class outside the class="" attribute.
        # Actually, replacing old_style with ' class="flex-view-fixed"' means it will look like:
        # <section id="view-about" class="view" class="flex-view-fixed">
        # This is invalid HTML.
        # Let's fix that. We should instead insert flex-view-fixed into the class attribute.
        
        # Re-read content to ensure clean replacement
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
            
        if old_style in content:
            content = content.replace(old_style, '') # Just remove it
            # Now add flex-view-fixed to class="view ..."
            # We can use regex to find class="view(.*?)" and add flex-view-fixed
            content = re.sub(r'class="view([^"]*)"', r'class="view flex-view-fixed\1"', content)
        
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f"Fixed {filename}")

if __name__ == '__main__':
    process()
