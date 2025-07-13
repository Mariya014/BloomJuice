// server.js
import express from "express";
import Stripe from "stripe";
import cors from "cors";

const app = express();
app.use(cors(), express.json());

const stripe = new Stripe(process.env.STRIPE_SECRET_KEY, { apiVersion: "2022-11-15" });

app.post("/create-payment-intent", async (req, res) => {
  const { /* order, shipping, etc. */ } = req.body;

  // calculate order total server-side
  const amount = 3100; // $31.00 in cents

  const paymentIntent = await stripe.paymentIntents.create({
    amount,
    currency: "aud",
    automatic_payment_methods: { enabled: true }, 
    description: "Bloom Juice order",
    shipping: {
      name: req.body.fullName,
      address: { line1: req.body.address, city: req.body.city, postal_code: req.body.zip, country: "AU" }
    },
    metadata: {
      order_id: "1234",
    },
  });

  res.json({
    clientSecret: paymentIntent.client_secret,
    publishableKey: process.env.STRIPE_PUBLISHABLE_KEY
  });
});

app.listen(4242, () => console.log("Server running on http://localhost:4242"));
