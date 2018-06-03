#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <stdint.h>

// We will not allocate more memory to an Erastothenes sieve than this many bytes.
// We choose 64MB, sufficient to handle requests up to 64000000 * 8 * 2 = 1024000000
// Larger primes will be generated manually using trial-and-error
// The program should handle most 64-bit input, although inputs beyond the above limit will be very slow
#define MAXSIEVESIZE 64000000

// bit i of table == whether 2i + 3 is prime
// This function returns nonzero if k is not prime, and 0 if it is.
const char flags[] = {128, 64, 32, 16, 8, 4, 2, 1};
int is_composite(char* table, uint64_t k){
	size_t k_reduced = (k-3)/2;
	return table[k_reduced >> 3] & flags[k_reduced%8];
}

void mark_as_composite(char* table, uint64_t k){
	size_t k_reduced = (k-3)/2;
	table[k_reduced >> 3] |= flags[k_reduced%8];
}

// All generated prime numbers will be stored in a linked-list
typedef struct prime_t {
	uint64_t p;
	struct prime_t* next;
} prime_t;

int main(int argc, char** argv){
	if(argc != 2){
		fprintf(stderr, "%s n : prints all prime numbers less than n.\n", argv[0]);
		exit(1);
	}

	uint64_t n = strtoull(argv[1], NULL, 10);
	uint64_t tablemax = n-1;

	size_t table_size = (n+15)/16;
	if(table_size > MAXSIEVESIZE){
		table_size = MAXSIEVESIZE;
		tablemax = MAXSIEVESIZE*16 + 1;
	}

	if(n <= 2) return 0;

	prime_t* first = malloc(sizeof(prime_t));
	first->p = 2;
	first->next = NULL;

	prime_t* last = first;
	printf("%lu\n", last->p);

	char* table = malloc(table_size);
	memset(table, 0, table_size);

	uint64_t k = 3;
	for(; k <= tablemax; k += 2){
		if(is_composite(table, k)) continue;
		prime_t* nextnum = malloc(sizeof(prime_t));
		nextnum->p = k;
		nextnum->next = NULL;
		last->next = nextnum;
		last = nextnum;
		printf("%lu\n", nextnum->p);
		for(uint64_t i = 3*k; i <= tablemax; i += 2*k){
			mark_as_composite(table, i);
		}
	}

	free(table);

	// Further extend the list by brute force
	// Slower than the sieve method, but uses less memory
	for(; k < n; k += 2){
		int isprime = 1;
		for(prime_t *curr = first; curr; curr = curr->next){
			if(k%(curr->p) == 0){
				isprime = 0;
				break;
			}
		}
		if(isprime == 1){
			prime_t* nextnum = malloc(sizeof(prime_t));
			nextnum->p = k;
			nextnum->next = NULL;
			last->next = nextnum;
			last = nextnum;
			printf("%lu\n", nextnum->p);
		}
	}

	// All done, free the list
	while(first){
		prime_t* tofree = first;
		first = first->next;
		free(tofree);
	}

	return 0;
}