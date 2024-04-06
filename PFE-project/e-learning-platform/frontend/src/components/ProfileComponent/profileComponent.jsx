/* eslint-disable react/prop-types */
import { Avatar, Divider, Input, Textarea, Badge, Button, Spinner } from '@nextui-org/react'
import useForm from '../../hooks/useForm'
import { UPDATE_PROFILE_API } from '../../api/apis';
import Alert from '../Alert';

const Profile = () => {
    const authUser = JSON.parse(localStorage.getItem('user'));

    const apiKey = `${UPDATE_PROFILE_API}/${authUser.id}`;
    const initialState = {
        'firstName': authUser.firstName,
        'lastName': authUser.lastName,
        'email': authUser.email,
        'password': '',
        'passwordConfirmation': '',
        'bio': authUser.bio,
    }

    let color = ''

    switch (authUser.role) {
        case "director":
            color = 'secondary'
            break;

        case "professor":
            color = 'danger'
            break;

        case "student":
            color = 'warning'
            break;
    }

    const { inputs, errors, data, isLoading, handleChange, handleSubmit, message } = useForm(initialState, apiKey, 'put', false, true);

    
    if (data) {
        localStorage.setItem('user', JSON.stringify(data.data.data));
        // console.log(data);
    }


    return (
        <div className='px-1 space-y-3'>
            <div>
                <h1 className='text-2xl font-bold'>My Profile</h1>
            </div>

            <div className='flex xs:sm:flex-col md:lg:flex-row items-center gap-3 justify-center'>
                <div className='flex flex-col items-center gap-2'>

                    <Badge
                        content={authUser.role}
                        color={color}
                        className="font-semibold px-2 py-0.5"
                        shape="rectangle"
                        size="sm"
                        variant="flat"

                    />

                    <form onSubmit={handleSubmit}>
                        <div className='flex flex-col items-center mt-2'>
                            <Avatar
                                isBordered
                                color={color}
                                name={`${(authUser.firstName).charAt(0).toUpperCase()}`}
                                className='md:lg:w-32 md:lg:h-32 xs:sm:w-20 xs:sm:h-20 my-2 text-4xl'
                            />

                            <span className='text-sm font-medium my-2'>Edit profile</span>

                        </div>


                        {message && <Alert color='success' message={message} />}
                        <div className='grid grid-cols-2 gap-2 md:lg:mx-72'>
                            <Divider className='col-span-2 mb-3' />


                            <Input variant="bordered"
                                label="Firstname"
                                value={inputs['firstName']}
                                errorMessage={errors['firstName']}
                                onChange={(e) => {
                                    handleChange('firstName', e.target.value)
                                    // handleChange('username', generateUsername(e.target.value, inputs['lastName']))
                                }
                                }
                            />

                            <Input variant="bordered"
                                label="Lastname"
                                value={inputs['lastName']}
                                errorMessage={errors['lastName']}
                                onChange={(e) => {
                                    handleChange('lastName', e.target.value)
                                    // handleChange('username', generateUsername(inputs['firstName'], e.target.value))
                                }}
                            />

                            <Input variant="bordered"
                                label="email"
                                className='col-span-2'
                                value={inputs['email']}
                                errorMessage={errors['email']}
                                onChange={(e) => handleChange('email', e.target.value)}
                            />

                            <Input variant="bordered"
                                label="Password"
                                type='password'
                                value={inputs['password']}
                                errorMessage={errors['password']}
                                onChange={(e) => handleChange('password', e.target.value)}
                            />

                            <Input variant="bordered"
                                label="Password Confirmation"
                                type='password'
                                value={inputs['passwordConfirmation']}
                                errorMessage={errors['passwordConfirmation']}
                                onChange={(e) => handleChange('passwordConfirmation', e.target.value)}
                            />

                            <Textarea
                                variant='bordered'
                                placeholder='Your bio goes here'
                                className='col-span-2'
                                defaultValue={inputs['bio']}
                                errorMessage={errors['bio']}
                                onChange={(e) => handleChange('bio', e.target.value)}
                            >

                            </Textarea>
                            <Button
                                type='submit'
                                className="bg-foreground text-background mt-1"
                            >
                                {isLoading ? (<div className='flex items-center gap-1'><Spinner color="default" /> Updating...</div>) : 'Update'}
                            </Button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    )
}

export default Profile
