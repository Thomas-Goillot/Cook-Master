package com.example.cookmaster;

public class ShopItem {
    private String name;
    private String price;
    private String image;

    public ShopItem(String name, String price, String image) {
        this.name = name;
        this.price = price;
        this.image = image;
    }

    public String getName() {
        return this.name;
    }

    public String getPrice() {
        return this.price;
    }

    public String getImage() {
        return this.image;
    }
}
