const nodemailer = require("nodemailer");

let transporter = nodemailer.createTransport({
  service: "gmail",
  auth: {
    user: "your-email@example.com",
    pass: "your-email-password",
  },
});

let mailOptions = {
  from: "your-email@example.com",
  to: "customer-email@example.com",
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
