import { configureStore } from '@reduxjs/toolkit'
import { directorSlice } from './features/Director/directorSlice'
import { professorSlice } from './features/Professor/professorSlice'
import { studentSlice } from './features/Student/studentSlice';

export const store = configureStore({
    reducer: {
        director: directorSlice.reducer,
        professor: professorSlice.reducer,
        student: studentSlice.reducer
    },
})