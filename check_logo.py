from PIL import Image
import numpy as np

def check_brightness(path):
    img = Image.open(path).convert('RGBA')
    arr = np.array(img)
    # Get alpha mask
    alpha = arr[:,:,3] > 10
    if not np.any(alpha): return "empty"
    # Get average RGB of non-transparent pixels
    rgb = arr[:,:,0:3][alpha]
    avg = np.mean(rgb)
    return "Light Theme Logo (White text)" if avg > 150 else "Dark Theme Logo (Dark text)"

print("logo.png: ", check_brightness('public/assets/media/logo.png'))
print("logo1.png: ", check_brightness('public/assets/media/logo1.png'))
