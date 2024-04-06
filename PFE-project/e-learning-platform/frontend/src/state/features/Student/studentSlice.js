import { createSlice } from "@reduxjs/toolkit";

const initialState = {
    user: {},
    myProfessors: [],
    courses: [],
    announcements:[],
    quizzes: [],
    grades: [],
    tasks: [],
    renderAction: false

}

export const studentSlice = createSlice({
    name: 'student',
    initialState,
    reducers: {
        saveStudent: (state, action) => {
            state.user = action.payload
        },

        saveMyProfessors: (state, action) => {
            state.myProfessors = action.payload
        },

        saveAnnouncements: (state, action) => {
            state.announcements = action.payload
        },

        saveCourses: (state, action) => {
            state.courses = action.payload
        },

        saveQuizzes: (state, action) => {
            state.quizzes = action.payload
        },

        saveGrades: (state, action) => {
            state.grades = action.payload
        },

        saveTasks: (state, action) => {
            state.tasks = action.payload
        },

        handleRenderAction: (state) => {
            state.renderAction = !state.renderAction
        }
    }
})

export const {
        saveMyProfessors, 
        saveAnnouncements, 
        saveTasks, 
        saveCourses, 
        saveQuizzes, 
        handleRenderAction, 
        saveGrades, 
    } = studentSlice.actions;

export default createSlice.reducer