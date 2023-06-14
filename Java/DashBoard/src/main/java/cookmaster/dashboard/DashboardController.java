package cookmaster.dashboard;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
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

import java.io.IOException;
import java.sql.ResultSet;
import java.sql.SQLException;

public class DashboardController {

    @FXML
    private Button closeButton;

    @FXML
    private Button disconnectButton;

    @FXML
    private Button eventButton;

    @FXML
    private Button presentationButton;

    @FXML
    private Label nameLabel;

    private int idUser;

    private double xOffset = 0;
    private double yOffset = 0;

    @FXML
    private TableView<UserInfo> userTableInfo;

    @FXML
    private Label counterUsers;

    @FXML
    private Label counterRh;

    @FXML
    private Label counterProviders;

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
    public void handleEventButtonClicked() throws IOException, SQLException {
        FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("dashboardEvent.fxml"));
        Parent root = fxmlLoader.load();
        DashboardEventController eventController = fxmlLoader.getController();
        eventController.setIdUserAndInitialise(idUser);
        Scene scene = new Scene(root);
        Stage stage = new Stage();

        Stage oldStage = (Stage) eventButton.getScene().getWindow();
        oldStage.close();
        stage.setTitle("CookMaster Dashboard Event");
        stage.initStyle(StageStyle.TRANSPARENT);
        stage.setScene(scene);
        stage.show();
    }

    @FXML
    public void handlePresentationButtonClicked(ActionEvent actionEvent) throws SQLException, IOException {
        FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("dashboardPresentation.fxml"));
        Parent root = fxmlLoader.load();
        DashboardPresentationController dashboardPresentationController = fxmlLoader.getController();
        dashboardPresentationController.setIdUserAndInitialise(idUser);
        Scene scene = new Scene(root);
        Stage stage = new Stage();

        Stage oldStage = (Stage) presentationButton.getScene().getWindow();
        oldStage.close();
        stage.setTitle("CookMaster Login");
        stage.initStyle(StageStyle.TRANSPARENT);
        stage.setScene(scene);
        stage.show();
    }

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

        ResultSet AllUsersInfo = databaseConnexion.getAllUserWithSubscriptionName();

        int counter = databaseConnexion.getNumberOfUsers();
        counterUsers.setText(String.valueOf(counter));
        counter = databaseConnexion.getNumberOfRh();
        counterRh.setText(String.valueOf(counter));
        counter = databaseConnexion.getNumberOfProviders();
        counterProviders.setText(String.valueOf(counter));

        createTableColumns();
        addUsersToTableView(AllUsersInfo);

    }

    public void setIdUserAndInitialise(int idUser) throws SQLException {
        this.idUser = idUser;
        Initialise();
    }

    private void createTableColumns() {
        TableColumn<UserInfo, Integer> idColumn = new TableColumn<>("#");
        idColumn.setCellValueFactory(new PropertyValueFactory<>("idUsers"));

        TableColumn<UserInfo, String> nameColumn = new TableColumn<>("Nom");
        nameColumn.setCellValueFactory(new PropertyValueFactory<>("name"));

        TableColumn<UserInfo, String> surnameColumn = new TableColumn<>("Prenom");
        surnameColumn.setCellValueFactory(new PropertyValueFactory<>("surname"));

        TableColumn<UserInfo, String> emailColumn = new TableColumn<>("Email");
        emailColumn.setCellValueFactory(new PropertyValueFactory<>("email"));

        TableColumn<UserInfo, String> subscriptionColumn = new TableColumn<>("Abonnement");
        subscriptionColumn.setCellValueFactory(new PropertyValueFactory<>("subscriptionName"));

        TableColumn<UserInfo, String> addressColumn = new TableColumn<>("Adresse");
        addressColumn.setCellValueFactory(new PropertyValueFactory<>("address"));

        TableColumn<UserInfo, String> cityColumn = new TableColumn<>("Ville");
        cityColumn.setCellValueFactory(new PropertyValueFactory<>("city"));

        TableColumn<UserInfo, String> zipCodeColumn = new TableColumn<>("Code Postal");
        zipCodeColumn.setCellValueFactory(new PropertyValueFactory<>("zipCode"));

        TableColumn<UserInfo, String> countryColumn = new TableColumn<>("Pays");
        countryColumn.setCellValueFactory(new PropertyValueFactory<>("country"));

        TableColumn<UserInfo, String> phoneColumn = new TableColumn<>("Téléphone");
        phoneColumn.setCellValueFactory(new PropertyValueFactory<>("phone"));

        userTableInfo.getColumns().addAll(idColumn, nameColumn, surnameColumn, emailColumn, subscriptionColumn,
                addressColumn, cityColumn, zipCodeColumn, countryColumn, phoneColumn);
    }

    private void addUsersToTableView(ResultSet resultSet) throws SQLException {
        ObservableList<UserInfo> userInfoList = FXCollections.observableArrayList();

        while (resultSet.next()) {
            int idUsers = resultSet.getInt("id_users");
            String name = resultSet.getString("name");
            String surname = resultSet.getString("surname");
            String email = resultSet.getString("email");
            String subscriptionName = resultSet.getString("subscription_name");
            String address = resultSet.getString("address");
            String city = resultSet.getString("city");
            String zipCode = resultSet.getString("zip_code");
            String country = resultSet.getString("country");
            String phone = resultSet.getString("phone");

            UserInfo userInfo = new UserInfo(idUsers, name, surname, email, subscriptionName, address, city, zipCode, country, phone);
            userInfoList.add(userInfo);

        }

        userTableInfo.setItems(userInfoList);
    }


}