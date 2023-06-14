package cookmaster.dashboard;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.stage.Stage;
import javafx.stage.StageStyle;
import org.w3c.dom.events.Event;

import java.io.IOException;
import java.sql.ResultSet;
import java.sql.SQLException;

public class DashboardEventController {

    @FXML
    private Button closeButton;

    @FXML
    private Button disconnectButton;

    @FXML
    private Label nameLabel;

    @FXML
    private Button userButton;

    @FXML
    private TableView<EventInfo> eventTableInfo;

    private int idUser;

    public void Initialise() throws SQLException {
        DatabaseConnexion databaseConnexion = new DatabaseConnexion();
        databaseConnexion.connect();
        User userInfo = databaseConnexion.getUserById(idUser);

        if (userInfo != null) {
            String fullName = userInfo.getName() + " " + userInfo.getSurname();
            nameLabel.setText(fullName);
        } else {
            System.out.println("Utilisateur introuvable");
        }

        ResultSet AllEvent = databaseConnexion.getAllEvent();

        createTableColumns();
        addEventToTableView(AllEvent);

    }

    public void setIdUserAndInitialise(int idUser) throws SQLException {
        this.idUser = idUser;
        Initialise();
    }

    @FXML
    public void handleDisconnectButtonClick() throws IOException {
        Parent fxmlLoader = FXMLLoader.load(getClass().getResource("connexion.fxml"));
        Scene scene = new Scene(fxmlLoader);
        Stage stage = new Stage();
        Stage oldStage = (Stage) disconnectButton.getScene().getWindow();
        oldStage.close();
        stage.setTitle("CookMaster Login");
        stage.initStyle(StageStyle.TRANSPARENT);
        stage.setScene(scene);
        stage.show();
    }

    @FXML
    public void handleCloseButtonClicked() {
        Stage stage = (Stage) closeButton.getScene().getWindow();
        stage.close();
    }

    @FXML
    private void handleUserButtonClicked() throws IOException, SQLException {
        FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("dashboard.fxml"));
        Parent root = fxmlLoader.load();
        DashboardController dashboardController = fxmlLoader.getController();
        dashboardController.setIdUserAndInitialise(idUser);
        Scene scene = new Scene(root);
        Stage stage = new Stage();

        Stage oldStage = (Stage) userButton.getScene().getWindow();
        oldStage.close();
        stage.setTitle("CookMaster Login");
        stage.initStyle(StageStyle.TRANSPARENT);
        stage.setScene(scene);
        stage.show();
    }

    private void createTableColumns() {
        TableColumn<EventInfo, Integer> idColumn = new TableColumn<>("#");
        idColumn.setCellValueFactory(new PropertyValueFactory<>("idEvent"));

        TableColumn<EventInfo, String> nameColumn = new TableColumn<>("Nom");
        nameColumn.setCellValueFactory(new PropertyValueFactory<>("name"));

        TableColumn<EventInfo, String> descriptionColumn = new TableColumn<>("Description");
        descriptionColumn.setCellValueFactory(new PropertyValueFactory<>("description"));
        descriptionColumn.setMaxWidth(500);
        descriptionColumn.setMinWidth(50);
        descriptionColumn.setPrefWidth(150);

        TableColumn<EventInfo, Float> priceColumn = new TableColumn<>("Prix");
        priceColumn.setCellValueFactory(new PropertyValueFactory<>("price"));

        TableColumn<EventInfo, Integer> placeColumn = new TableColumn<>("Place");
        placeColumn.setCellValueFactory(new PropertyValueFactory<>("place"));

        TableColumn<EventInfo, String> startColumn = new TableColumn<>("Début");
        startColumn.setCellValueFactory(new PropertyValueFactory<>("dateStart"));

        TableColumn<EventInfo, String> endColumn = new TableColumn<>("Fin");
        endColumn.setCellValueFactory(new PropertyValueFactory<>("dateEnd"));

        eventTableInfo.getColumns().addAll(idColumn, nameColumn, descriptionColumn, priceColumn, placeColumn, startColumn, endColumn);
    }

    private void addEventToTableView(ResultSet resultSet) throws SQLException {
        ObservableList<EventInfo> eventInfoList = FXCollections.observableArrayList();

        while (resultSet.next()) {
            int idEvent = resultSet.getInt("id_event");
            String name = resultSet.getString("name");
            String description = resultSet.getString("description");
            float price = resultSet.getFloat("price");
            int place = resultSet.getInt("place");
            String dateStart = resultSet.getString("date_start");
            String dateEnd = resultSet.getString("date_end");

            EventInfo eventInfo = new EventInfo(idEvent, name, description, price, place, dateStart, dateEnd);
            eventInfoList.add(eventInfo);

        }

        eventTableInfo.setItems(eventInfoList);
    }


}