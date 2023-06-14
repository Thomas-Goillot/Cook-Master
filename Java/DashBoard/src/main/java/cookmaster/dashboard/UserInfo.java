package cookmaster.dashboard;

public class UserInfo {
    private int idUsers;
    private String name;
    private String surname;
    private String email;
    private String subscriptionName;
    private String address;
    private String city;
    private String zipCode;
    private String country;
    private String phone;

    public UserInfo(int idUsers, String name, String surname, String email, String subscriptionName, String address,
                    String city, String zipCode, String country, String phone) {
        this.idUsers = idUsers;
        this.name = name;
        this.surname = surname;
        this.email = email;
        this.subscriptionName = subscriptionName;
        this.address = address;
        this.city = city;
        this.zipCode = zipCode;
        this.country = country;
        this.phone = phone;
    }

    public int getIdUsers() {
        return idUsers;
    }

    public String getName() {
        return name;
    }

    public String getSurname() {
        return surname;
    }

    public String getEmail() {
        return email;
    }

    public String getSubscriptionName() {
        return subscriptionName;
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

    public String getPhone() {
        return phone;
    }
}
