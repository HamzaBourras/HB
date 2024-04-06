import { createSlice } from "@reduxjs/toolkit";

const initialState = {
    professors: [],
    departments: [],
    sectors: [],
    staticstics: [],
    students: [],
    renderAction: false
}

export const directorSlice = createSlice({
    name: 'director',
    initialState,
    reducers: {
        saveProfessors: (state, action) => {
            state.professors = action.payload
        },

        saveDepartments: (state, action) => {
            state.departments = action.payload
        },
        
        saveSectors: (state, action) => {
            state.sectors = action.payload
        },

        saveStudents: (state, action) => {
            state.students = action.payload
        },

        saveStaticstics: (state, action) => {
            state.staticstics = action.payload
        },

        handleRenderAction: (state) => {
            state.renderAction = !state.renderAction
        }
    }
})

export const { saveProfessors, saveDepartments, saveSectors, saveStaticstics, saveStudents, handleRenderAction } = directorSlice.actions;

export default createSlice.reducer