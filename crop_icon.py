from PIL import Image

def process():
    try:
        # Load the image
        img = Image.open('assets/images/newicone.png').convert("RGBA")
        
        data = img.getdata()
        newData = []
        for item in data:
            # Treat almost black as transparent
            if item[0] < 20 and item[1] < 20 and item[2] < 20:
                newData.append((0, 0, 0, 0))
            else:
                newData.append(item)
                
        temp_img = Image.new("RGBA", img.size)
        temp_img.putdata(newData)
        
        bbox = temp_img.getbbox()
        if bbox:
            print(f"Original size: {img.size}, Bounding box: {bbox}")
            cropped = img.crop(bbox)
            
            # Make it a perfect square
            max_dim = max(cropped.size)
            # Add a tiny 5% margin so it's not literally touching the pixel edge
            margin = int(max_dim * 0.05)
            full_dim = max_dim + (margin * 2)
            
            # The background of the new image
            bg_color = (0, 0, 0, 255) # Use black since the original used black
            square_img = Image.new("RGBA", (full_dim, full_dim), bg_color)
            
            paste_x = margin + (max_dim - cropped.size[0]) // 2
            paste_y = margin + (max_dim - cropped.size[1]) // 2
            
            square_img.paste(cropped, (paste_x, paste_y))
            
            final_img = square_img.resize((512, 512), Image.Resampling.LANCZOS)
            final_img.save('assets/images/newicone.png')
            print("Successfully cropped the black background and scaled the icon to fill the entire square!")
        else:
            print("Could not find a bounding box.")
            
    except Exception as e:
        print(f"Error: {e}")

if __name__ == '__main__':
    process()
