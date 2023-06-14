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



}