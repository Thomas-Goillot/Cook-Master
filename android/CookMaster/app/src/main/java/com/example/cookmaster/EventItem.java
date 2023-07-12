package com.example.cookmaster;

public class EventItem {
    private String name;
    private String price;
    private String date;

    public EventItem(String name, String price, String date) {
        this.name = name;
        this.price = price;
        this.date = date;
    }

    public String getName() {
        return this.name;
    }

    public String getPrice() {
        return this.price;
    }

    public String getDate() {
        return this.date;
    }

}
