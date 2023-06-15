module cookmaster.dashboard {
    requires javafx.controls;
    requires javafx.fxml;

    requires org.controlsfx.controls;
    requires org.kordamp.ikonli.javafx;
    requires org.kordamp.bootstrapfx.core;
    requires java.sql;
    requires pdfbox.app;
    requires java.desktop;

    opens cookmaster.dashboard to javafx.fxml;
    exports cookmaster.dashboard;
}