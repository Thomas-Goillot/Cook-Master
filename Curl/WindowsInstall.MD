# Installation Of Gtk,Glade and Curl for Windows 

## Installation of MSYS2 for Windows
- Download and install MSYS2 from https://www.msys2.org/
- Open MSYS2 MinGW 64-bit
- Update MSYS2
```bash
pacman -Syu
```
- Add 'C:\msys64\mingw64\bin' to the PATH environment variable

## Installation of gcc and make for Windows
- Install cmake
```bash
pacman -S mingw-w64-x86_64-cmake
```
- Install gcc
```bash
pacman -S mingw-w64-x86_64-gcc
```
- Install make
```bash
pacman -S mingw-w64-x86_64-make
```
- Install toolchain
```bash
pacman -S --needed base-devel mingw-w64-x86_64-toolchain
```

## Installation of gtk3 and glade for Windows
- Install gtk3-devel
```bash
pacman -S mingw-w64-x86_64-gtk3
```
- Install glade
```bash
pacman -S mingw-w64-x86_64-glade
```
- Install devhelp
```bash
pacman -S mingw-w64-x86_64-devhelp
```

## Compile and run the program
- Open MSYS2 MinGW 64-bit
- Go to the project directory
```bash
cd /path/to/project
```
- Compile the program
```bash
gcc -o $(PROGRAM_NAME) myfile.c -Wall `pkg-config --cflags --libs gtk+-3.0`
```
- or compile with make
```bash
make
```
- Run the program
```bash
./$(PROGRAM_NAME)
```

## Installation of curl for Windows
- Install curl
```bash
pacman -S mingw-w64-x86_64-curl
```
