package cookmaster.dashboard;

public class EventInfo {

    private int idEvent;
    private String name;
    private String description;
    private Float price;
    private int place;
    private String dateStart;
    private String dateEnd;

    public EventInfo(int idEvent, String name, String description, Float price, int place, String dateStart, String dateEnd) {
        this.idEvent = idEvent;
        this.name = name;
        this.description = description;
        this.price = price;
        this.place = place;
        this.dateStart = dateStart;
        this.dateEnd = dateEnd;
    }


    public int getIdEvent() {
        return idEvent;
    }

    public void setIdEvent(int idEvent) {
        this.idEvent = idEvent;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public float getPrice() {
        return price;
    }

    public void setPrice(float price) {
        this.price = price;
    }

    public int getPlace() {
        return place;
    }

    public void setPlace(int place) {
        this.place = place;
    }

    public String getDateStart() {
        return dateStart;
    }

    public void setDateStart(String dateStart) {
        this.dateStart = dateStart;
    }

    public String getDateEnd() {
        return dateEnd;
    }

    public void setDateEnd(String dateEnd) {
        this.dateEnd = dateEnd;
    }
}
