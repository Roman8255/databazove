import random

def control(pocet_prvkov, pocet_cieisl):
    global arr
    pocet = 0
    while True:
        for i in range(int(len(arr)/2)):
            if arr[i] != arr[len(arr)-i-1]:
                arr = random.choices(range(pocet_cieisl), k=pocet_prvkov)  # Generovanie nových náhodných čísel
                pocet += 1
                break
        else:
            return pocet

# Príklad použitia:
pocet_prvkov = 8
pocet_cieisl = 10
arr = random.choices(range(pocet_cieisl), k=pocet_prvkov)
print("Počet iterácií:", control(pocet_prvkov, pocet_cieisl))
print(arr)
