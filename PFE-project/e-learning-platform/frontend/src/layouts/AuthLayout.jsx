/* eslint-disable react/prop-types */
import { Outlet, Navigate } from 'react-router-dom'
import Background from '../assets/images/bg.png'
const AuthLayout = () => {


    if (!localStorage.getItem('token') && !localStorage.getItem('user')) {
        return <Navigate to='/' replace />;
    }

    return (
        <div className=''>
            <img className="absolute -z-50 object-cover w-full h-full opacity-30" src={Background}/>
            <main>
                <Outlet />
            </main>
        </div>
    );
};

export default AuthLayout;