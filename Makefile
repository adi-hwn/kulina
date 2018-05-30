all: prima fibonacci nol

prima: prima.c
	gcc prima.c -o prima

fibonacci: fibonacci.c
	gcc fibonacci.c -o fibonacci

nol: nol.c
	gcc nol.c -o nol

