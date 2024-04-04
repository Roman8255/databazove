import pygame
from pygame.locals import *
from OpenGL.GL import *
from OpenGL.GLUT import *
from OpenGL.GLU import *

# Inicializácia Pygame
pygame.init()

# Rozmery obrazovky
WIDTH, HEIGHT = 800, 600

# Inicializácia okna Pygame
pygame.display.set_mode((WIDTH, HEIGHT), DOUBLEBUF | OPENGL)

# Nastavenie perspektívy
gluPerspective(45, (WIDTH / HEIGHT), 0.1, 50.0)

# Posunutie kamery
glTranslatef(0.0, 0.0, -5)

# Hlavný cyklus
while True:
    for event in pygame.event.get():
        if event.type == pygame.QUIT:
            pygame.quit()
            quit()
        elif event.type == pygame.MOUSEBUTTONDOWN:
            if event.button == 1:  # ľavé tlačidlo myši
                # Získať súradnice kliknutia myši
                x, y = event.pos
                # Vypočítať súradnice 3D bodu
                mouseX = (2.0 * x / WIDTH - 1.0)
                mouseY = (2.0 * (HEIGHT - y) / HEIGHT - 1.0)
                # Vypočítať súradnicu z
                z = glReadPixels(x, HEIGHT - y, 1, 1, GL_DEPTH_COMPONENT, GL_FLOAT)
                # Vypočítať súradnice x, y, z
                winX, winY, winZ = gluUnProject(mouseX, mouseY, z[0][0], glGetDoublev(GL_MODELVIEW_MATRIX),
                                                 glGetDoublev(GL_PROJECTION_MATRIX), glGetIntegerv(GL_VIEWPORT))
                print("Súradnice bodu:", winX, winY, winZ)

    # Vyčistiť obrazovku a buffer hĺbky
    glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT)

    # Vykreslenie osí
    glBegin(GL_LINES)
    glColor3fv((1, 0, 0))  # Červená os X
    glVertex3fv((0, 0, 0))
    glVertex3fv((1, 0, 0))
    glColor3fv((0, 1, 0))  # Zelená os Y
    glVertex3fv((0, 0, 0))
    glVertex3fv((0, 1, 0))
    glColor3fv((0, 0, 1))  # Modrá os Z
    glVertex3fv((0, 0, 0))
    glVertex3fv((0, 0, 1))
    glEnd()

    # Vykresliť body

    pygame.display.flip()
    pygame.time.wait(10)
