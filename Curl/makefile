# Nom de votre programme
PROGRAM_NAME = CookMasterApiRequest

# Compilateur C
CC = gcc

# Options de compilation pour gtk et glade
CFLAGS = `pkg-config --cflags gtk+-3.0` `pkg-config --cflags libcurl`

# Options de compilation pour gtk et glade
LIBS = `pkg-config --libs gtk+-3.0` -I /mingw64/include/mysql -L /mingw64/lib/mysql -l mysqlclient -L./curlLib/lib -lcurl -ljansson


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


run:
	make
	./$(PROGRAM_NAME)


mysql:
	gcc -o db dbConnexion.c -I /mingw64/include/mysql -L /mingw64/lib/mysql -l mysqlclient


