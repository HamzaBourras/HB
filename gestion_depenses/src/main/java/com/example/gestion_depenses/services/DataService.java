package com.example.gestion_depenses.services;

import com.example.gestion_depenses.models.Transaction;
import com.example.gestion_depenses.utils.JsonUtil;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;

import java.io.File;
import java.util.ArrayList;
import java.util.List;

public class DataService {
    private static final String DATA_FILE_PATH = "data/transactions.json";

    public void saveTransactions(String transactions) {
        JsonUtil.writeToJsonFile(transactions, DATA_FILE_PATH);
    }

    public ObservableList<Transaction> loadTransactions() {
        File dataFile = new File(DATA_FILE_PATH);
        if (dataFile.exists()) {
            List<Transaction> transactions = JsonUtil.readFromJsonFile(DATA_FILE_PATH, Transaction.class);
            return FXCollections.observableArrayList(transactions);
        }
        return FXCollections.observableArrayList();
    }

    public double getTotalExpenses() {
        return 0;
    }

    public void saveTransaction(Transaction transaction) {

    }
}