#include <stdio.h>
#include <stdlib.h>
#include <stdint.h>

int main(int argc, char** argv){
	if(argc != 2){
		fprintf(stderr, "%s n : prints all Fibonacci numbers less than n.\n", argv[0]);
		exit(1);
	}

	uint64_t n = strtoull(argv[1], NULL, 10);
	uint64_t f0 = 0;
	uint64_t f1 = 1;
	uint64_t f2 = 1;
	if(n > 0){
		printf("0\n");
	}
	if(n > 1){
		printf("1\n");
	}
	// We do not use simply (n > f0 + f1) to prevent overflow
	// This program can handle all n up to 64 bits and
	// displays the appropriate Fibonacci numbers,
	// up to and including F_95 = 12200160415121876738
	while(n - f0 > f1){
		f2 = f0 + f1;
		f0 = f1;
		f1 = f2;
		printf("%lu\n", f1);
	}
	return 0;
}