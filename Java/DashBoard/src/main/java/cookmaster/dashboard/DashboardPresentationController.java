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

import java.io.IOException;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.time.LocalDateTime;

public class DashboardPresentationController {

    @FXML
    private Button closeButton;

    @FXML
    private Button disconnectButton;

    @FXML
    private Label nameLabel;

    @FXML
    private Button userButton;

    @FXML
    private Button eventButton;

    private int idUser;

    @FXML
    private TableView<PrestationInfo> prestationTableInfo;

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

        ResultSet AllPrestation = databaseConnexion.getAllAllPrestation();

        createTableColumns();
        addPrestationToTableView(AllPrestation);

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

    private void createTableColumns() {
        TableColumn<PrestationInfo, Integer> idColumn = new TableColumn<>("#");
        idColumn.setCellValueFactory(new PropertyValueFactory<>("id_courses"));

        TableColumn<PrestationInfo, String> specialRequestColumn = new TableColumn<>("Demande spéciale");
        specialRequestColumn.setCellValueFactory(new PropertyValueFactory<>("special_request"));

        TableColumn<PrestationInfo, LocalDateTime> dateOfCoursesColumn = new TableColumn<>("Date des cours");
        dateOfCoursesColumn.setCellValueFactory(new PropertyValueFactory<>("date_of_courses"));

        TableColumn<PrestationInfo, LocalDateTime> dateOfRequestColumn = new TableColumn<>("Date de la demande");
        dateOfRequestColumn.setCellValueFactory(new PropertyValueFactory<>("date_of_request"));

        TableColumn<PrestationInfo, Integer> statutColumn = new TableColumn<>("Statut");
        statutColumn.setCellValueFactory(new PropertyValueFactory<>("statut"));

        TableColumn<PrestationInfo, String> linkColumn = new TableColumn<>("Lien");
        linkColumn.setCellValueFactory(new PropertyValueFactory<>("link"));

        TableColumn<PrestationInfo, Integer> typeColumn = new TableColumn<>("Type");
        typeColumn.setCellValueFactory(new PropertyValueFactory<>("type"));

        TableColumn<PrestationInfo, Integer> idProvidersColumn = new TableColumn<>("ID Fournisseurs");
        idProvidersColumn.setCellValueFactory(new PropertyValueFactory<>("id_providers"));

        TableColumn<PrestationInfo, Integer> idUsersColumn = new TableColumn<>("ID Utilisateurs");
        idUsersColumn.setCellValueFactory(new PropertyValueFactory<>("id_users"));

        TableColumn<PrestationInfo, String> addressColumn = new TableColumn<>("Adresse");
        addressColumn.setCellValueFactory(new PropertyValueFactory<>("address"));

        TableColumn<PrestationInfo, String> cityColumn = new TableColumn<>("Ville");
        cityColumn.setCellValueFactory(new PropertyValueFactory<>("city"));

        TableColumn<PrestationInfo, String> zipCodeColumn = new TableColumn<>("Code Postal");
        zipCodeColumn.setCellValueFactory(new PropertyValueFactory<>("zip_code"));

        TableColumn<PrestationInfo, String> countryColumn = new TableColumn<>("Pays");
        countryColumn.setCellValueFactory(new PropertyValueFactory<>("country"));

        TableColumn<PrestationInfo, Double> totalPriceColumn = new TableColumn<>("Prix Total");
        totalPriceColumn.setCellValueFactory(new PropertyValueFactory<>("total_price"));

        TableColumn<PrestationInfo, String> commentaryColumn = new TableColumn<>("Commentaire");
        commentaryColumn.setCellValueFactory(new PropertyValueFactory<>("commentary"));

        prestationTableInfo.getColumns().addAll(idColumn, specialRequestColumn, dateOfCoursesColumn, dateOfRequestColumn,
                statutColumn, linkColumn, typeColumn, idProvidersColumn, idUsersColumn, addressColumn, cityColumn,
                zipCodeColumn, countryColumn, totalPriceColumn, commentaryColumn);
    }


    private void addPrestationToTableView(ResultSet resultSet) throws SQLException {
        ObservableList<PrestationInfo> prestationInfoList = FXCollections.observableArrayList();

        while (resultSet.next()) {
            int idCourses = resultSet.getInt("id_courses");
            String specialRequest = resultSet.getString("special_request");
            LocalDateTime dateOfCourses = resultSet.getTimestamp("date_of_courses").toLocalDateTime();
            LocalDateTime dateOfRequest = resultSet.getTimestamp("date_of_request").toLocalDateTime();
            int statut = resultSet.getInt("statut");
            String link = resultSet.getString("link");
            int type = resultSet.getInt("type");
            int idProviders = resultSet.getInt("id_providers");
            int idUsers = resultSet.getInt("id_users");
            String address = resultSet.getString("address");
            String city = resultSet.getString("city");
            String zipCode = resultSet.getString("zip_code");
            String country = resultSet.getString("country");
            double totalPrice = resultSet.getDouble("total_price");
            String commentary = resultSet.getString("commentary");

            PrestationInfo prestationInfo = new PrestationInfo(idCourses, specialRequest, dateOfCourses, dateOfRequest,
                    statut, link, type, idProviders, idUsers, address, city, zipCode, country, totalPrice, commentary);
            prestationInfoList.add(prestationInfo);
        }

        prestationTableInfo.setItems(prestationInfoList);
    }


}