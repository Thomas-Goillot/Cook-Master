package cookmaster.dashboard;

import java.time.LocalDateTime;

public class PrestationInfo {
    private int id_courses;
    private String special_request;
    private LocalDateTime date_of_courses;
    private LocalDateTime date_of_request;
    private int statut;
    private String link;
    private int type;
    private int id_providers;
    private int id_users;
    private String address;
    private String city;
    private String zip_code;
    private String country;
    private double total_price;
    private String commentary;

    // Constructeur
    public PrestationInfo(int id_courses, String special_request, LocalDateTime date_of_courses,
                          LocalDateTime date_of_request, int statut, String link, int type, int id_providers,
                          int id_users, String address, String city, String zip_code, String country,
                          double total_price, String commentary) {
        this.id_courses = id_courses;
        this.special_request = special_request;
        this.date_of_courses = date_of_courses;
        this.date_of_request = date_of_request;
        this.statut = statut;
        this.link = link;
        this.type = type;
        this.id_providers = id_providers;
        this.id_users = id_users;
        this.address = address;
        this.city = city;
        this.zip_code = zip_code;
        this.country = country;
        this.total_price = total_price;
        this.commentary = commentary;
    }

    // Getters et Setters
    public int getId_courses() {
        return id_courses;
    }

    public void setId_courses(int id_courses) {
        this.id_courses = id_courses;
    }

    public String getSpecial_request() {
        return special_request;
    }

    public void setSpecial_request(String special_request) {
        this.special_request = special_request;
    }

    public LocalDateTime getDate_of_courses() {
        return date_of_courses;
    }

    public void setDate_of_courses(LocalDateTime date_of_courses) {
        this.date_of_courses = date_of_courses;
    }

    public LocalDateTime getDate_of_request() {
        return date_of_request;
    }

    public void setDate_of_request(LocalDateTime date_of_request) {
        this.date_of_request = date_of_request;
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

    public int getId_providers() {
        return id_providers;
    }

    public void setId_providers(int id_providers) {
        this.id_providers = id_providers;
    }

    public int getId_users() {
        return id_users;
    }

    public void setId_users(int id_users) {
        this.id_users = id_users;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getCity() {
        return city;
    }

    public void setCity(String city) {
        this.city = city;
    }

    public String getZip_code() {
        return zip_code;
    }

    public void setZip_code(String zip_code) {
        this.zip_code = zip_code;
    }

    public String getCountry() {
        return country;
    }

    public void setCountry(String country) {
        this.country = country;
    }

    public double getTotal_price() {
        return total_price;
    }

    public void setTotal_price(double total_price) {
        this.total_price = total_price;
    }

    public String getCommentary() {
        return commentary;
    }

    public void setCommentary(String commentary) {
        this.commentary = commentary;
    }
}
