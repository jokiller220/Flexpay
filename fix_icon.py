from PIL import Image
import sys

def process_image(input_path, output_path, bg_color):
    try:
        img = Image.open(input_path).convert("RGBA")
        width, height = img.size
        
        # Create a new solid background image
        new_img = Image.new("RGBA", img.size, bg_color)
        
        # Paste the original image on top, using its alpha channel as a mask
        new_img.paste(img, (0, 0), img)
        
        # If the original image had a solid white background instead of transparency, we need to replace white pixels
        # Let's check if the corners are white
        pixels = new_img.load()
        corner_colors = [pixels[0,0], pixels[width-1,0], pixels[0,height-1], pixels[width-1,height-1]]
        is_white_bg = all(c[0] > 240 and c[1] > 240 and c[2] > 240 for c in corner_colors)
        
        if is_white_bg:
            # Replace white pixels with bg_color (tolerance for compression artifacts)
            print("Detected white background. Replacing with dark background...")
            for y in range(height):
                for x in range(width):
                    r, g, b, a = pixels[x, y]
                    if r > 230 and g > 230 and b > 230:
                        pixels[x, y] = (11, 16, 33, 255) # #0B1021
                        
        new_img.convert("RGB").save(output_path, "PNG")
        print(f"Successfully processed {input_path} and saved to {output_path}")
    except Exception as e:
        print(f"Error: {e}")

if __name__ == "__main__":
    process_image("assets/images/newicone.png", "assets/images/newicone_dark.png", (11, 16, 33, 255))
