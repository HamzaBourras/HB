/* eslint-disable react/prop-types */
import { Progress, Spinner } from "@nextui-org/react"
import { useState } from "react"

const ProgressComponent = ({ image, name, number, maxNumber, color }) => {
    const [isLoaded, setIsLoaded] = useState(false)
    setTimeout(()=>{    
        setIsLoaded(true)
    },500)
    return (
        <div className="border p-2 shadow-sm text-lg h-20 rounded-md flex flex-col justify-center space-y-1">
            <div className="flex space-x-2 justify-between items-center">
                <div>
                    <h1 className="text-gray-600 text-sm font-medium">{name}</h1>
                    {!isLoaded ? <Spinner size="sm" color={color}/> : (
                        <h1 className="text-gray-500 font-bold mx-4">{number}/{maxNumber}</h1>
                    )}
                </div>
                <div>
                    <img src={image} width={40} />
                </div>
            </div>

            <div className='flex items-center -z-20'>
                <Progress
                    color={color}
                    aria-label="Loading..."
                    maxValue={maxNumber}
                    value={number}
                    className="w-full"
                />
            </div>
        </div>
    )
}

export default ProgressComponent


/*

<div className='flex items-center space-x-1'>
                <img src={image} width={40} />
                <h1 className="text"><span className="">{number} {name}</span></h1>
            </div>
            <div className='flex items-center -z-20'>
                <Progress
                    color={color}
                    aria-label="Loading..."
                    maxValue={maxNumber}
                    value={number}
                    className="max-w-md"
                />
            </div>



*/