import { Avatar } from "@nextui-org/react"

/* eslint-disable react/prop-types */
const Card = ({ title, email }) => {
    return (
        <div
            className='border w-full h-12 rounded'
        >
            <div className='flex items-center p-0.5 gap-2'>
                <Avatar />
                <div>
                    <span className='font-medium text-sm'>{title}</span>
                    <p className='text-xs text-gray-500'>{email}</p>
                </div>
            </div>

        </div>
    )
}
export default Card