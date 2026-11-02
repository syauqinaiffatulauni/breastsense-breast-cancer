from flask import Flask, request, jsonify
import torch
import torch.nn as nn
from torchvision import models, transforms
from PIL import Image
import os
import time

# -------------------------
# LOAD RESNET18 MODEL
# -------------------------

resnet_model = models.resnet18(pretrained=False)

resnet_model.fc = nn.Linear(
    resnet_model.fc.in_features,
    3
)

resnet_model.load_state_dict(
    torch.load(
        "models/ResNet18_model_final.pth",
        map_location="cpu"
    )
)

resnet_model.eval()

# -------------------------
# FLASK APP
# -------------------------

app = Flask(__name__)

classes = ["Benign", "Malignant", "Normal"]

# -------------------------
# EXPLANATION FUNCTION
# -------------------------

def generate_explanation(pred_class, conf):

    if pred_class == "Normal":

        if conf > 0.80:
            return "Strong indication of normal breast tissue. No abnormal structures detected."

        elif conf > 0.60:
            return "Likely normal tissue, but slight variations observed."

        else:
            return "Uncertain result, but leaning towards normal tissue."

    elif pred_class == "Benign":

        if conf > 0.80:
            return "Strong indication of benign (non-cancerous) lesion."

        elif conf > 0.60:
            return "Likely benign tissue with mild irregularity."

        else:
            return "Uncertain benign prediction. Further assessment may be needed."

    else:

        if conf > 0.80:
            return "Strong malignant features detected."

        elif conf > 0.60:
            return "Suspicious malignant patterns detected."

        else:
            return "Weak malignant signals detected."

# -------------------------
# PREDICT ROUTE
# -------------------------

@app.route('/predict', methods=['POST'])
def predict():

    try:

        file = request.files['image']

        # -------------------------
        # SAVE INPUT IMAGE
        # -------------------------

        filename = f"input_{int(time.time())}.png"

        input_path = os.path.join(
            os.getcwd(),
            filename
        )

        file.save(input_path)

        # -------------------------
        # RESNET CLASSIFICATION
        # -------------------------

        image = Image.open(input_path).convert("RGB")

        transform = transforms.Compose([
            transforms.Resize((224, 224)),
            transforms.ToTensor(),
            transforms.Normalize(
                mean=[0.485, 0.456, 0.406],
                std=[0.229, 0.224, 0.225]
            )
        ])

        image_tensor = transform(image).unsqueeze(0)

        with torch.no_grad():

            output = resnet_model(image_tensor)

            probs = torch.softmax(output, dim=1)

            predicted = torch.argmax(probs, dim=1)

            confidence = probs[0, predicted.item()].item()

        prediction = classes[predicted.item()]

        explanation = generate_explanation(
            prediction,
            confidence
        )

        # -------------------------
        # RETURN RESPONSE
        # -------------------------

        return jsonify({

            "prediction": prediction,

            "confidence": round(
                confidence * 100,
                2
            ),

            "explanation": explanation,

        })

    except Exception as e:

        return jsonify({
            "error": str(e)
        }), 500

# -------------------------
# RUN SERVER
# -------------------------

if __name__ == '__main__':
    app.run(
        port=5000,
        debug=True
    )