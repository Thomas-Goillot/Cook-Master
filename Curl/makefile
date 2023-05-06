#
CC = gcc

CFLAGS= `pkg-config --cflags gtk+-3.0` `pkg-config --cflags libcurl` -I/mingw64/include/mysql

CLIBS= `pkg-config --libs gtk+-3.0` -L /mingw64/lib/ -lmysqlclient -L./curlLib/lib -lcurl -ljansson

EXE= executable

OBJ= obj/

SRC= src/

INCL= includes/

FILEC:= $(wildcard $(SRC)*.c)

FILEH:= $(wildcard $(INCL)*.h)

FILEO:= $(patsubst $(SRC)%.c,$(OBJ)%.o,$(FILEC))

$(EXE) : $(FILEO)
	$(CC) $(CFLAGS) -o $@ $^ $(CLIBS)


$(OBJ)main.o : $(SRC)main.c $(FILEH)
	$(CC) $(CFLAGS) -o $@ -c $<

$(OBJ)%.o : $(SRC)%.c $(INCL)%.h
	$(CC) $(CFLAGS) -o $@ -c $<

clean :
	rm -rf $(OBJ)*.o
	rm -rf $(EXE)

run :
	make
	./$(EXE)


