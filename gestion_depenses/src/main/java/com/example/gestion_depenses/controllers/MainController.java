package com.example.gestion_depenses.controllers;

import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Label;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import javafx.scene.control.ComboBox;
import com.example.gestion_depenses.models.Transaction;
import com.example.gestion_depenses.services.DataService;
import com.example.gestion_depenses.services.BudgetService;
import java.time.LocalDate;

public class MainController {

    @FXML
    private TableView<Transaction> transactionTable;

    @FXML
    private TextField amountField;

    @FXML
    private ComboBox<String> typeComboBox;

    @FXML
    private ComboBox<String> categoryComboBox;

    @FXML
    private TextField dateField;

    @FXML
    private TextField commentField;

    @FXML
    private Label budgetStatusLabel;

    private DataService dataService;
    private BudgetService budgetService;

    public MainController() {
        dataService = new DataService();
        budgetService = new BudgetService();
    }

    @FXML
    public void initialize() {
        loadTransactions();
        updateBudgetStatus();
    }

    @FXML
    private void addTransaction() {
        // Logic to add transaction
        double amount = Double.parseDouble(amountField.getText());
        String type = typeComboBox.getValue();
        String category = categoryComboBox.getValue();
        LocalDate date = LocalDate.parse(dateField.getText());
        String comment = commentField.getText();

        Transaction transaction = new Transaction(amount, type, category, date, comment);
        dataService.saveTransaction(transaction);
        loadTransactions();
        updateBudgetStatus();
    }

    private void loadTransactions() {
        transactionTable.setItems(dataService.loadTransactions());
    }

    private void updateBudgetStatus() {
        double totalExpenses = dataService.getTotalExpenses();
        double budgetLimit = budgetService.getMonthlyBudget();
        
        if (totalExpenses > budgetLimit) {
            budgetStatusLabel.setText("Budget exceeded!");
            budgetStatusLabel.setStyle("-fx-text-fill: red;");
            showAlert("Budget Alert", "You have exceeded your budget for this month!");
        } else {
            budgetStatusLabel.setText("Budget is within limits.");
            budgetStatusLabel.setStyle("-fx-text-fill: green;");
        }
    }

    private void showAlert(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.WARNING);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }

    public void handleAddTransaction(ActionEvent actionEvent) {
    }

    public void handleViewRecommendations(ActionEvent actionEvent) {
    }

    public void handleFilterByMonth(ActionEvent actionEvent) {
    }

    public void handleFilterByCategory(ActionEvent actionEvent) {
    }
}