/* eslint-disable react/prop-types */
import classNames from "classnames";


const Alert = ({ color, message }) => {
  let theme = null;

  switch (color) {
    case "success":
      theme = classNames({
        "border-emerald-200": color == "success",
        "bg-emerald-50": color == "success",
        "text-emerald-500": color == "success",
      });
      break;
    case "danger":
      theme = classNames({
        "border-red-200": color == "danger",
        "bg-red-50": color == "danger",
        "text-red-500": color == "danger",
      });
      break;
    default:
    theme = classNames({
      "border-blue-200": color == "",
      "bg-blue-50": color == "",
      "text-blue-500": color == "",
    });
    break;
  }


  return (
    <>
      <div
        className={`w-full px-2 py-3 text-sm border rounded ${theme} `}
        role="alert"
      >
        <p>{message}</p>
      </div>
    </>
  );
};

export default Alert;
