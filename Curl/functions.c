#include <ncurses.h>
int main()
{
    WINDOW *w;
    char list[5][40] = {"One", "Two", "Three", "Four", "Spoonacular"};
    char item[7];
    int ch, i = 0, width = 7;
    initscr();                // initialize Ncurses
    w = newwin(10, 50, 1, 1); // create a new window
    box(w, 0, 0);             // sets default borders for the window

    mvwprintw(w, 0, 15, "Cook Master Api");

    // now print all the menu items and highlight the first one
    
    for (i = 0; i < 5; i++)
    {
        if (i == 0)
            wattron(w, A_STANDOUT); // highlights the first item.
        else
            wattroff(w, A_STANDOUT);
        sprintf(item, "%-40s", list[i]);
        mvwprintw(w, i + 1, 2, "%s", item);
    }

    wrefresh(w); // update the terminal screen
    i = 0;
    noecho();        // disable echoing of characters on the screen
    keypad(w, TRUE); // enable keyboard input for the window.
    curs_set(0);     // hide the default screen cursor.
    // get the input
    
    while ((ch = wgetch(w)) != 'q')
    {
        // right pad with spaces to make the items appear with even width.
        sprintf(item, "%-10s", list[i]);
        mvwprintw(w, i + 1, 2, "%s", item);
        // use a variable to increment or decrement the value based on the input.
        switch (ch)
        {
        case KEY_UP:
            i--;
            i = (i < 0) ? 4 : i;
            break;
        case KEY_DOWN:
            i++;
            i = (i > 4) ? 0 : i;
            break;
        }
        // now highlight the next item in the list.
        wattron(w, A_STANDOUT);
        sprintf(item, "%-10s", list[i]);
        mvwprintw(w, i + 1, 2, "%s", item);
        wattroff(w, A_STANDOUT);
        wrefresh(w); // update the terminal screen
    }
    delwin(w);
    endwin();
}