import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import Breadcrumb from '../../components/Breadcrumbs/Breadcrumb';
import ExampleImage from '../../images/logo/logo1.png';
import { registerUser } from '../../api/authApi';
import { ToastContainer, toast } from 'react-toastify';
import { Button } from '@nextui-org/react';

import 'react-toastify/dist/ReactToastify.css';

const SignUp: React.FC = () => {
  const [username, setUsername] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [isLoading, setIsLoading] = useState(false);

  const navigate = useNavigate();

  const regisHandler = async (e) => {
    e.preventDefault();
    setIsLoading(true);

    const data = {
      username: username,
      email: email,
      password: password,
    };

    try {
      const res = await registerUser(data);
      toast.success('Registration successful!', {
        onClose: () => navigate('/auth/signin'),
      });
      setIsLoading(false);
    } catch (error) {
      toast.error('Registration failed. Please try again.');
      console.error(error);
      setIsLoading(false);
    }
  };

  return (
    <div className="mx-32 mt-5">
      <ToastContainer />
      <div className="rounded-sm border border-stroke bg-white shadow-default">
        <div className="flex flex-wrap items-center">
          <div className="hidden w-full xl:block xl:w-1/2">
            <div className="flex justify-center">
              <img
                src={ExampleImage}
                alt="Example"
                className="max-w-xs rounded-lg"
              />
            </div>

            <div className="2xl:px-20 text-center mt-20">
              <h2
                className="font-bold"
                style={{
                  color: '#28517D',
                  textShadow: '2px 2px 4px rgba(0, 0, 0, 0.25)',
                }}
              >
                WELCOME TO
              </h2>
              <h3
                className="font-bold"
                style={{
                  color: '#28517D',
                  textShadow: '2px 2px 4px rgba(0, 0, 0, 0.25)',
                }}
              >
                IT SLA MAINTENANCE
              </h3>
            </div>
          </div>

          <div className="w-full border-stroke dark:border-strokedark xl:w-1/2 xl:border-l-2">
            <div className="w-full p-4 sm:p-12.5 xl:p-17.5">
              <h2 className="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
                Sign Up to Website
              </h2>

              <form onSubmit={regisHandler}>
                <div className="mb-4">
                  <label className="mb-2.5 block font-medium text-black dark:text-white">
                    Name
                  </label>
                  <div className="relative">
                    <input
                      type="text"
                      placeholder="Enter your full name"
                      className="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 text-black outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      value={username}
                      onChange={(e) => setUsername(e.target.value)}
                    />

                    <span className="absolute right-4 top-4">
                      <svg
                        className="fill-current"
                        width="22"
                        height="22"
                        viewBox="0 0 22 22"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <g opacity="0.5">
                          <path
                            d="M11.0008 9.52185C13.5445 9.52185 15.607 7.5281 15.607 5.0531C15.607 2.5781 13.5445 0.584351 11.0008 0.584351C8.45703 0.584351 6.39453 2.5781 6.39453 5.0531C6.39453 7.5281 8.45703 9.52185 11.0008 9.52185ZM11.0008 2.1656C12.6852 2.1656 14.0602 3.47185 14.0602 5.08748C14.0602 6.7031 12.6852 8.00935 11.0008 8.00935C9.31641 8.00935 7.94141 6.7031 7.94141 5.08748C7.94141 3.47185 9.31641 2.1656 11.0008 2.1656Z"
                            fill=""
                          />
                          <path
                            d="M13.2352 11.0687H8.76641C5.08828 11.0687 2.09766 14.0937 2.09766 17.7719V20.625C2.09766 21.0375 2.44141 21.4156 2.88828 21.4156C3.33516 21.4156 3.67891 21.0719 3.67891 20.625V17.7719C3.67891 14.9531 5.98203 12.6156 8.83516 12.6156H13.2695C16.0883 12.6156 18.4258 14.9187 18.4258 17.7719V20.625C18.4258 21.0375 18.7695 21.4156 19.2164 21.4156C19.6633 21.4156 20.007 21.0719 20.007 20.625V17.7719C19.9039 14.0937 16.9133 11.0687 13.2352 11.0687Z"
                            fill=""
                          />
                        </g>
                      </svg>
                    </span>
                  </div>
                </div>

                <div className="mb-4">
                  <label className="mb-2.5 block font-medium text-black dark:text-white">
                    Email
                  </label>
                  <div className="relative">
                    <input
                      type="email"
                      placeholder="Enter your email"
                      className="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 text-black outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      value={email}
                      onChange={(e) => setEmail(e.target.value)}
                    />

                    <span className="absolute right-4 top-4">
                      <svg
                        className="fill-current"
                        width="22"
                        height="22"
                        viewBox="0 0 22 22"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <g opacity="0.5">
                          <path
                            d="M19.2516 3.30005H2.75156C1.58281 3.30005 0.585938 4.26255 0.585938 5.46567V16.6032C0.585938 17.7719 1.54844 18.7688 2.75156 18.7688H19.2516C20.4203 18.7688 21.4172 17.8063 21.4172 16.6032V5.4313C21.4172 4.26255 20.4203 3.30005 19.2516 3.30005ZM19.2516 4.84692C19.2859 4.84692 19.3203 4.84692 19.3547 4.84692L11.0016 10.2094L2.64844 4.84692C2.68281 4.84692 2.71719 4.84692 2.75156 4.84692H19.2516ZM19.2516 17.1532H2.75156C2.40781 17.1532 2.13281 16.8782 2.13281 16.5344V6.35942L10.1766 11.5157C10.4172 11.6875 10.6922 11.7894 10.9672 11.7894C11.2422 11.7894 11.5172 11.6875 11.7234 11.5157L19.7672 6.35942V16.5344C19.7859 16.8782 19.5109 17.1532 19.2516 17.1532Z"
                            fill=""
                          />
                        </g>
                      </svg>
                    </span>
                  </div>
                </div>

                <div className="mb-6">
                  <label className="mb-2.5 block font-medium text-black dark:text-white">
                    Password
                  </label>
                  <div className="relative">
                    <input
                      type="password"
                      placeholder="Enter your password"
                      className="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 text-black outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      value={password}
                      onChange={(e) => setPassword(e.target.value)}
                    />

                    <span className="absolute right-4 top-4">
                      <svg
                        className="fill-current"
                        width="22"
                        height="22"
                        viewBox="0 0 22 22"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <g opacity="0.5">
                          <path
                            fillRule="evenodd"
                            clipRule="evenodd"
                            d="M20.625 11C20.625 15.3963 16.9838 19.0375 11 19.0375C5.01625 19.0375 1.375 15.3963 1.375 11C1.375 6.60375 5.01625 2.9625 11 2.9625C16.9838 2.9625 20.625 6.60375 20.625 11ZM22 11C22 16.7547 17.431 21.375 11 21.375C4.569 21.375 0 16.7547 0 11C0 5.24531 4.569 0.625 11 0.625C17.431 0.625 22 5.24531 22 11ZM6.45 10.3625C6.12516 10.3625 5.8625 10.6252 5.8625 10.95V14.7953C5.8625 15.1202 6.12516 15.3828 6.45 15.3828H15.55C15.8748 15.3828 16.1375 15.1202 16.1375 14.7953V10.95C16.1375 10.6252 15.8748 10.3625 15.55 10.3625H6.45ZM7.9925 14.2078V11.5363H14.0075V14.2078H7.9925Z"
                            fill=""
                          />
                        </g>
                      </svg>
                    </span>
                  </div>
                </div>

                <div className="mb-6">
                  <Button
                    type="submit"
                    className="inline-flex w-full items-center justify-center rounded-lg bg-indigo-800 py-2 px-3 text-center text-white font-medium hover:bg-primary-dark"
                    isLoading={isLoading}
                  >
                    Sign Up
                  </Button>
                </div>

                <div className="text-center">
                  <p className="text-sm font-medium text-black dark:text-white">
                    Already have an account?{' '}
                    <Link
                      to="/auth/signin"
                      className="text-primary hover:underline"
                    >
                      Sign In
                    </Link>
                  </p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default SignUp;
