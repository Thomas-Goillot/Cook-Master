# Nom de votre programme
PROGRAM_NAME = CookMasterCurlDemo

# Compilateur C
CC = gcc

# Options de compilation
CFLAGS = -Wall -I./curlLib/include

# Bibliothèques à lier
LIBS = -L./curlLib/lib -lcurl

# Liste des fichiers source de votre projet
SOURCES = main.c

# Liste des fichiers objet à générer
OBJECTS = $(SOURCES:.c=.o)

# Règle de construction du programme
$(PROGRAM_NAME): $(OBJECTS)
	$(CC) $(CFLAGS) -o $@ $^ $(LIBS)

# Règle de construction des fichiers objet
%.o: %.c
	$(CC) $(CFLAGS) -c -o $@ $<

# Nettoyage des fichiers temporaires
clean:
	rm -f $(OBJECTS) $(PROGRAM_NAME)