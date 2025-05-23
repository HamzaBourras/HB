package com.example.gestion_depenses.models;

import java.util.List;

public class Recommendation {
    private String advice;
    private List<String> tips;

    public Recommendation(String advice) {
        this.advice = advice;
        this.tips = tips;
    }

    public String getAdvice() {
        return advice;
    }

    public void setAdvice(String advice) {
        this.advice = advice;
    }

    public List<String> getTips() {
        return tips;
    }

    public void setTips(List<String> tips) {
        this.tips = tips;
    }
}