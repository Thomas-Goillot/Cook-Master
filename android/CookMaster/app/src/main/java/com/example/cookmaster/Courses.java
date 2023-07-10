package com.example.cookmaster;

public class Courses {
    private String specialRequest;
    private String dateOfCourses;
    private String dateOfRequest;
    private int statut;
    private String link;
    private int type;
    private String address;
    private String city;
    private String zipCode;
    private String country;
    private int totalPrice;
    private String commentary;

    public String getSpecialRequest() {
        return specialRequest;
    }

    public String getDateOfCourses() {
        return dateOfCourses;
    }

    public String getDateOfRequest() {
        return dateOfRequest;
    }

    public int getStatut() {
        return statut;
    }

    public String getLink() {
        return link;
    }

    public int getType() {
        return type;
    }

    public String getAddress() {
        return address;
    }

    public String getCity() {
        return city;
    }

    public String getZipCode() {
        return zipCode;
    }

    public String getCountry() {
        return country;
    }

    public int getTotalPrice() {
        return totalPrice;
    }

    public String getCommentary() {
        return commentary;
    }

    public Courses(String specialRequest, String dateOfCourses, String dateOfRequest, int statut, String link, int type, String address, String city, String zipCode, String country, int totalPrice, String commentary) {
        this.specialRequest = specialRequest;
        this.dateOfCourses = dateOfCourses;
        this.dateOfRequest = dateOfRequest;
        this.statut = statut;
        this.link = link;
        this.type = type;
        this.address = address;
        this.city = city;
        this.zipCode = zipCode;
        this.country = country;
        this.totalPrice = totalPrice;
        this.commentary = commentary;
    }
}
