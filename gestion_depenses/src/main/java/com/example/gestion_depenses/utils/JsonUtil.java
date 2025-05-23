package com.example.gestion_depenses.utils;

import com.example.gestion_depenses.models.Transaction;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import com.google.gson.reflect.TypeToken;

import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.lang.reflect.Type;
import java.util.ArrayList;
import java.util.List;

public class JsonUtil {

    private static final Gson gson = new GsonBuilder().setPrettyPrinting().create();

    public static <T> void writeToJsonFile(String filePath, String data) {
        try (FileWriter writer = new FileWriter(filePath)) {
            gson.toJson(data, writer);
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public static <T> List<T> readFromJsonFile(String filePath, Class<T> classType) {
        try (FileReader reader = new FileReader(filePath)) {
            Type listType = TypeToken.getParameterized(List.class, classType).getType();
            return gson.fromJson(reader, listType);
        } catch (IOException e) {
            e.printStackTrace();
            return new ArrayList<>();
        }
    }
}