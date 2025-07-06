const stripe = Stripe("pk_test_51IWaksDzFpbE9UOcAEC96mt4Ed9ECCOxvqjYLnA2YWsPET9RygPsbamByC8pIQ5FBIWp3C8TCwcEyNuL6f9UjpyV00YcKD4dof");

const urlParams = new URLSearchParams(window.location.search);
const policyId = urlParams.get("policy_id");

if (!policyId) {
  alert("Missing policy ID for payment.");
  throw new Error("Missing policy ID");
}

let elements;

initialize();

document
  .querySelector("#payment-form")
  .addEventListener("submit", handleSubmit);

async function initialize() {
  // Example usage in checkout.js
const { clientSecret, policyName, amountLKR } = await fetch("../public/create.php", {
  method: "POST",
  headers: { "Content-Type": "application/json" },
  body: JSON.stringify({ policy_id: policyId }),
}).then((res) => res.json());

document.querySelector("#item-name").textContent = policyName;
document.querySelector("#amount-lkr").textContent = `LKR ${amountLKR}`;


  elements = stripe.elements({ clientSecret });

  const paymentElementOptions = { layout: "accordion" };
  const paymentElement = elements.create("payment", paymentElementOptions);
  paymentElement.mount("#payment-element");
}

async function handleSubmit(e) {
  e.preventDefault();
  setLoading(true);

  const { error } = await stripe.confirmPayment({
    elements,
    confirmParams: {
      return_url: `http://localhost/safenest_life_system/public/complete.html?policy_id=${policyId}`,
    },
  });

  if (error?.type === "card_error" || error?.type === "validation_error") {
    showMessage(error.message);
  } else {
    showMessage("An unexpected error occurred.");
  }

  setLoading(false);
}

function showMessage(messageText) {
  const messageContainer = document.querySelector("#payment-message");
  messageContainer.classList.remove("hidden");
  messageContainer.textContent = messageText;

  setTimeout(() => {
    messageContainer.classList.add("hidden");
    messageContainer.textContent = "";
  }, 4000);
}

function setLoading(isLoading) {
  const submitBtn = document.querySelector("#submit");
  const spinner = document.querySelector("#spinner");
  const buttonText = document.querySelector("#button-text");

  submitBtn.disabled = isLoading;
  spinner.classList.toggle("hidden", !isLoading);
  buttonText.classList.toggle("hidden", isLoading);
}
