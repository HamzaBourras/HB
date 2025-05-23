package com.example.gestion_depenses.controllers;

import com.example.gestion_depenses.models.Transaction;
import com.example.gestion_depenses.services.DataService;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;

import java.time.LocalDate;

public class TransactionController {

    @FXML
    private TableView<Transaction> transactionTable;
    @FXML
    private TableColumn<Transaction, String> amountColumn;
    @FXML
    private TableColumn<Transaction, String> typeColumn;
    @FXML
    private TableColumn<Transaction, String> categoryColumn;
    @FXML
    private TableColumn<Transaction, LocalDate> dateColumn;
    @FXML
    private TableColumn<Transaction, String> commentColumn;

    @FXML
    private TextField amountField;
    @FXML
    private ComboBox<String> typeComboBox;
    @FXML
    private ComboBox<String> categoryComboBox;
    @FXML
    private DatePicker datePicker;
    @FXML
    private TextArea commentField;

    private ObservableList<Transaction> transactionList;
    private DataService dataService;

    public TransactionController() {
        dataService = new DataService();
        transactionList = FXCollections.observableArrayList();
    }

    @FXML
    public void initialize() {
        amountColumn.setCellValueFactory(new PropertyValueFactory<>("amount"));
        typeColumn.setCellValueFactory(new PropertyValueFactory<>("type"));
        categoryColumn.setCellValueFactory(new PropertyValueFactory<>("category"));
        dateColumn.setCellValueFactory(new PropertyValueFactory<>("date"));
        commentColumn.setCellValueFactory(new PropertyValueFactory<>("comment"));

        transactionTable.setItems(transactionList);
        loadTransactions();
    }

    @FXML
    public void addTransaction() {
        String amount = amountField.getText();
        String type = typeComboBox.getValue();
        String category = categoryComboBox.getValue();
        LocalDate date = datePicker.getValue();
        String comment = commentField.getText();

        if (amount.isEmpty() || type == null || category == null || date == null) {
            showAlert("Please fill in all fields.");
            return;
        }

        Transaction transaction = new Transaction(Double.parseDouble(amount), type, category, date, comment);
        transactionList.add(transaction);
        dataService.saveTransaction(transaction);
        clearFields();
    }

    private void loadTransactions() {
        transactionList.clear();
        transactionList.addAll(dataService.loadTransactions());
    }

    private void clearFields() {
        amountField.clear();
        typeComboBox.setValue(null);
        categoryComboBox.setValue(null);
        datePicker.setValue(null);
        commentField.clear();
    }

    private void showAlert(String message) {
        Alert alert = new Alert(Alert.AlertType.WARNING);
        alert.setTitle("Warning");
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }

    public void handleAddTransaction(ActionEvent actionEvent) {
    }

    public void handleFilter(ActionEvent actionEvent) {
    }
}