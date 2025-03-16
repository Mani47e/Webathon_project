const express = require("express");
const nodemailer = require("nodemailer");
const cors = require("cors");
const bodyParser = require("body-parser");
require("dotenv").config();

const app = express();
const PORT = 3000;

// Middleware
app.use(cors());
app.use(bodyParser.json());

// Nodemailer setup
const transporter = nodemailer.createTransport({
    service: "gmail",
    auth: {
        user: nelakurthivaralakshmi, // Your email
        pass: varamegha0831  // Your email password or app password
    }
});

// API Endpoint to send email
app.post("/send-email", async (req, res) => {
    const { email } = req.body;

    const mailOptions = {
        from: process.env.EMAIL_USER,
        to: email,
        subject: "Order Confirmation",
        text: "Hello, your order has been successfully completed! Thank you for your purchase."
    };

    try {
        await transporter.sendMail(mailOptions);
        res.json({ message: "Email sent successfully!" });
    } catch (error) {
        res.status(500).json({ message: "Error sending email", error });
    }
});

// Start server
app.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
});
