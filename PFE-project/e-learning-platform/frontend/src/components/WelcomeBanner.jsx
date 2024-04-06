/* eslint-disable react/prop-types */


const WelcomeBanner = ({ children, user }) => {
    return (
        <div className="space-y-1">
            <div className="flex justify-between items-center rounded border-b p-0.5 ">
                <h1 className="h2 text-gray-600">Welcome back, <span className="font-normal"> {user} !</span></h1>
                <div>
                    {children}
                </div>
            </div>
        </div>
    )
}
export default WelcomeBanner