/* eslint-disable react/prop-types */
const CardImage = ({ image, title, size }) => {
    return (
        <div className="flex items-center space-x-4 p-2 m-1 w-full bg-blue-50 bg-opacity-15 rounded-md border">
            <img
                className={`${size != null ? 'w-10' : 'w-16'}` }
                src={image}
            />
            <h1 className={`font-semibold ${size != null ? 'text-xs' : 'text-2xl'} text-gray-500`}>{ title }</h1>
        </div>
    )
}
export default CardImage