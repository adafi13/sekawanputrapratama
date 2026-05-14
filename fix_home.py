import re

with open('resources/views/frontend/home.blade.php', 'r') as f:
    content = f.read()

# Remove <style> after HERO SECTION comment
content = content.replace("{{-- ==========================================\n     HERO SECTION (ORBITAL DESIGN)\n     ========================================== --}}\n<style>\n  /* Local Hero Styles matching screenshot */", "{{-- ==========================================\n     HERO SECTION (ORBITAL DESIGN)\n     ========================================== --}}\n  /* Local Hero Styles matching screenshot */")

# Extract the hero section HTML
hero_match = re.search(r'(<section class="hero-section">.*?</section>)', content, flags=re.DOTALL)
if hero_match:
    hero_html = hero_match.group(1)
    # Remove the hero section from its current place
    content = content.replace(hero_html, '')

# Remove the rogue </style> that was above the hero section
content = content.replace("  }\n</style>\n\n\n@keyframes pulse {", "  }\n\n@keyframes pulse {")

# Find the final </style> and append the hero_html
content = content.replace("</style>\n\n\n\n\n{{-- ==========================================\n     MARQUEE TECH STACK", "</style>\n\n" + hero_html + "\n\n{{-- ==========================================\n     MARQUEE TECH STACK")
content = content.replace("</style>\n\n{{-- ==========================================\n     MARQUEE TECH STACK", "</style>\n\n" + hero_html + "\n\n{{-- ==========================================\n     MARQUEE TECH STACK")


with open('resources/views/frontend/home.blade.php', 'w') as f:
    f.write(content)

print("Done")
