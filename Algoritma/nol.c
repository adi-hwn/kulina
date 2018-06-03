#include <stdio.h>
#include <stdlib.h>
#include <stdint.h>
#include <string.h>

#define SKIPPEDCHARS ",. "

int main(int argc, char** argv){
	if(argc != 2){
		fprintf(stderr, "%s n : generates output according to format shown in pdf (Algoritma no.3).\n", argv[0]);
		exit(1);
	}

	size_t len = 0;
	for(char* c = argv[1]; *c != '\0'; c++){
		if(!strchr(SKIPPEDCHARS, *c)){
			if(*c < '0' || *c > '9'){
				fprintf(stderr, "Input is not a number\n");
				exit(1);
			}
			len++;
		}
	}

	char* zeros = malloc(len + 1);
	memset(zeros, '0', len);
	zeros[len] = '\0';

	size_t skip = 1;
	for(size_t i = 0; i < strlen(argv[1]); i++){
		if(!strchr(SKIPPEDCHARS, argv[1][i])){
			printf("%c%s\n", argv[1][i], zeros+skip);
			skip++;
		}
	}

	free(zeros);

	return 0;
}