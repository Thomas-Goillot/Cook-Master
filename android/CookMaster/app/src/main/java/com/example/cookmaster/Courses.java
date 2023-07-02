package com.example.cookmaster;

public class Courses {
    private int idCourses;
    private String specialRequest;
    private String dateOfCourses;
    private String dateOfRequest;
    private int statut;
    private String link;
    private int type;
    private int idUser;
    private String address;
    private String city;
    private String zipCode;
    private String country;
    private double totalPrice;

    public String getDate() {
        return dateOfCourses;
    }

    public void setDate(String date) {
        this.dateOfCourses = date;
    }

    public String getSpecialRequest() {
        return specialRequest;
    }

    public void setSpecialRequest(String specialRequest) {
        this.specialRequest = specialRequest;
    }

    public String getDateOfRequest() {
        return dateOfRequest;
    }

    public void setDateOfRequest(String dateOfRequest) {
        this.dateOfRequest = dateOfRequest;
    }

    public int getStatut() {
        return statut;
    }

    public void setStatut(int statut) {
        this.statut = statut;
    }

    public String getLink() {
        return link;
    }

    public void setLink(String link) {
        this.link = link;
    }

    public int getType() {
        return type;
    }

    public void setType(int type) {
        this.type = type;
    }

    public int getIdUser() {
        return idUser;
    }

    public void setIdUser(int idUser) {
        this.idUser = idUser;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public int getIdCourses() {
        return idCourses;
    }

    public void setIdCourses(int idCourses) {
        this.idCourses = idCourses;
    }

    public String getCity() {
        return city;
    }

    public void setCity(String city) {
        this.city = city;
    }

    public double getTotalPrice() {
        return totalPrice;
    }

    public void setTotalPrice(double totalPrice) {
        this.totalPrice = totalPrice;
    }

    public String getZipCode() {
        return zipCode;
    }

    public void setZipCode(String zipCode) {
        this.zipCode = zipCode;
    }

    public String getCountry() {
        return country;
    }

    public void setCountry(String country) {
        this.country = country;
    }

    public Courses(int idCourses, String specialRequest, String dateOfCourses, String dateOfRequest, int statut, String link, int type, int idUser, String address, String city, String zipCode, String country, double totalPrice) {
        this.idCourses = idCourses;
        this.specialRequest = specialRequest;
        this.dateOfCourses = dateOfCourses;
        this.dateOfRequest = dateOfRequest;
        this.statut = statut;
        this.link = link;
        this.type = type;
        this.idUser = idUser;
        this.address = address;
        this.city = city;
        this.zipCode = zipCode;
        this.country = country;
        this.totalPrice = totalPrice;
    }
}
