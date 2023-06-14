package cookmaster.dashboard;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import javafx.stage.Stage;
import javafx.stage.StageStyle;

import java.io.IOException;
import java.nio.charset.StandardCharsets;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import static cookmaster.dashboard.PasswordHasher.hashPassword;

public class ConnexionController {

    @FXML
    private Button closeButton;

    @FXML
    private TextField email;

    @FXML
    private PasswordField password;

    private DatabaseConnexion databaseConnexion;

    private double xOffset = 0;
    private double yOffset = 0;

    public void initialize() {
        databaseConnexion = new DatabaseConnexion();
        databaseConnexion.connect();
    }

    @FXML
    public void handleConnexionButtonClicked() throws IOException, NoSuchAlgorithmException, SQLException {
        openDashboard(1);
        //String email = this.email.getText();
        //String password = this.password.getText();
//
        //String hashedPassword = hashPassword(password);
//
        //int isAuthenticated = databaseConnexion.checkUserIsAdmin(email, hashedPassword);
        //if (isAuthenticated > 0) {
        //    databaseConnexion.setUserId(isAuthenticated);
        //    openDashboard(isAuthenticated);
        //} else {
        //    showErrorAlert("Identifiants incorrects", "Veuillez vérifier votre email et votre mot de passe. Si vous n'êtes pas administrateur, veuillez contacter un administrateur.");
        //}
    }

    @FXML
    public void handleCloseButtonClicked() {
        Stage stage = (Stage) closeButton.getScene().getWindow();
        stage.close();
    }

    private void showErrorAlert(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle(title);
        alert.setContentText(message);
        alert.showAndWait();
    }

    public void disconnectDatabase() {
        databaseConnexion.disconnect();
    }

    private void openDashboard(int idUser) throws IOException, SQLException {
        FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("dashboard.fxml"));
        Parent root = fxmlLoader.load();
        DashboardController dashboardController = fxmlLoader.getController();
        dashboardController.setIdUserAndInitialise(idUser);

        Scene scene = new Scene(root);
        Stage stage = new Stage();
        Stage oldStage = (Stage) closeButton.getScene().getWindow();
        oldStage.close();
        stage.setTitle("CookMaster Dashboard");
        stage.initStyle(StageStyle.TRANSPARENT);

        scene.setOnMousePressed(event -> {
            xOffset = event.getSceneX();
            yOffset = event.getSceneY();
        });

        scene.setOnMouseDragged(event -> {
            stage.setX(event.getScreenX() - xOffset);
            stage.setY(event.getScreenY() - yOffset);
        });


        stage.setScene(scene);
        stage.show();
    }



}