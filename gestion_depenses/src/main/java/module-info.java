module com.example.gestion_depenses {
    requires javafx.controls;
    requires javafx.fxml;

    requires org.kordamp.bootstrapfx.core;
    requires com.google.gson;

    opens com.example.gestion_depenses to javafx.fxml;
    exports com.example.gestion_depenses;
}