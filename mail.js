const nodemailer = require("nodemailer");

let transporter = nodemailer.createTransport({
  service: "gmail",
  auth: {
    user: "michelfarday66@gmail.com",
    pass: "chandu",
  },
});

let mailOptions = {
  from: "michelfarday66@gmail.com",
  to: "adhiramatteru@gmail.com",
  subject: "Order Confirmation",
  text: "Hello, your order has been completed successfully! Thank you for your purchase.",
};

transporter.sendMail(mailOptions, function (error, info) {
  if (error) {
    console.log(error);
  } else {
    console.log("Email sent: " + info.response);
  }
});
