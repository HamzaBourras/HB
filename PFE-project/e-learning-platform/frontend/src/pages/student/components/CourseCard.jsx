/* eslint-disable react/prop-types */
const CourseCard = ({ image, title }) => {
    return (
        <div className="m-2 border px-2 py-1 rounded hover:bg-gray-50 hover:cursor-pointer flex flex-col items-center text-center space-y-1">
            <img
                src={image}
                alt={title}
                className="size-16 flex-1 object-contain"
            />
            <h1 className="text-xs font-medium">{title}</h1>
        </div>
    )
}
export default CourseCard