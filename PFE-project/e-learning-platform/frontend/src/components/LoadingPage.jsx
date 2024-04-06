import { Spinner } from '@nextui-org/react'

const LoadingPage = () => {
    return (
        <div className="absolute w-screen inset-0 flex justify-center items-center">
            <Spinner 
                size='lg'
                color='primary'/>
        </div>
    )
}

export default LoadingPage