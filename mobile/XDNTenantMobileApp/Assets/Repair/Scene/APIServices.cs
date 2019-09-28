using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using SimpleJSON;
using UnityEngine.Networking;
using UnityEngine.UI;

public class APIServices : MonoBehaviour
{
    float elapsedTime;
    float TIME_OUT = 15.0f;
    
    private string endpoint = "http://18.140.54.91:7338";
    string responseToken = "";
    public Text buyResponse;
    public Text coinAmount;


    private void Start()
    {
        StartCoroutine(getCoin());   
    }

    public IEnumerator getCoin()
    {
        var json = "{\"method\": \"getaddressbalances\",\"params\": [\"14YzXsRpFFzbqDbiyMNnHpZVhUszVdc3YhD5Pr\"],\"id\": \"83307641-1563603597\",\"chain_name\": \"dlt_xdn\"}";
        var uwr = new UnityWebRequest(endpoint, "POST");
        byte[] jsonToSend = new System.Text.UTF8Encoding().GetBytes(json);
        uwr.uploadHandler = (UploadHandler)new UploadHandlerRaw(jsonToSend);
        uwr.downloadHandler = (DownloadHandler)new DownloadHandlerBuffer();
        uwr.SetRequestHeader("Authorization", "Basic bXVsdGljaGFpbnJwYzpGQzhCQnI3dUJtamk0OVRoZVE5TkU3cmRGYVZtYXVaaEdRelNqeWpVRWhpWQ==");
        uwr.SetRequestHeader("Content-Type", "application/json");
        uwr.SetRequestHeader("Content-Type", "application/json");

        //Send the request then wait here until it returns
        yield return uwr.SendWebRequest();

        if (uwr.isNetworkError)
        {
            Debug.Log("Error While Sending: " + uwr.error);
        }
        else
        {
            Debug.Log("Received: " + uwr.downloadHandler.text);
            ParseCoinAmount(uwr.downloadHandler.text);
            

        }
    }

    void ParseCoinAmount(string queryResult)
    {
        JSONNode node = JSON.Parse(queryResult);
        string userID = node["result"][0]["qty"];

        Debug.Log("UserID: " + userID);
        
        coinAmount.text = userID;
    }

    

    IEnumerator PostRequest()
    {
        //var json = "{\"method\":\"sendassetfrom\",\"params\":[\"14YzXsRpFFzbqDbiyMNnHpZVhUszVdc3YhD5Pr\",\"1UppndQL8gKuTRSiwAiTLkvRWMGTt3rWdmiuXB\",\"xdncoin\",199\"],\"id\":\"63219905-1563605760\",\"chain_name\":\"dlt_xdn\"}";
        var json = "{\"method\":\"sendassetfrom\",\"params\":[\"14YzXsRpFFzbqDbiyMNnHpZVhUszVdc3YhD5Pr\",\"1UppndQL8gKuTRSiwAiTLkvRWMGTt3rWdmiuXB\",\"xdncoin\",1000],\"id\":\"63219905 - 1563605760\",\"chain_name\":\"dlt_xdn\"}";
        //var json = "{ \"method\":\"getinfo\",\"params\":[],\"id\":\"10491388-1563593076\",\"chain_name\":\"dlt_xdn\"}";
        var uwr = new UnityWebRequest(endpoint, "POST");
        byte[] jsonToSend = new System.Text.UTF8Encoding().GetBytes(json);
        uwr.uploadHandler = (UploadHandler)new UploadHandlerRaw(jsonToSend);
        uwr.downloadHandler = (DownloadHandler)new DownloadHandlerBuffer();
        uwr.SetRequestHeader("Authorization", "Basic bXVsdGljaGFpbnJwYzpGQzhCQnI3dUJtamk0OVRoZVE5TkU3cmRGYVZtYXVaaEdRelNqeWpVRWhpWQ==");
        uwr.SetRequestHeader("Content-Type", "application/json");
        uwr.SetRequestHeader("Content-Type", "application/json");

        //Send the request then wait here until it returns
        yield return uwr.SendWebRequest();

        if (uwr.isNetworkError)
        {
            Debug.Log("Error While Sending: " + uwr.error);
        }
        else
        {
            Debug.Log("Received: " + uwr.downloadHandler.text);
            buyResponse.text = "Successfully bought: " + uwr.downloadHandler.text;
            StartCoroutine(getCoin());

        }
    }
    public IEnumerator buyItem()
    {
        var jsonStr = "{\"method\":\"sendassetfrom\",\"params\":[\"14YzXsRpFFzbqDbiyMNnHpZVhUszVdc3YhD5Pr\",\"1UppndQL8gKuTRSiwAiTLkvRWMGTt3rWdmiuXB\",\"xdncoin\",199\"],\"id\":\"63219905-1563605760\",\"chain_name\":\"dlt_xdn\"}";
        var byteArray = System.Text.Encoding.UTF8.GetBytes(jsonStr);
        WWWForm data = new WWWForm();
        data.AddBinaryData("body", byteArray);

        using (UnityWebRequest req = UnityWebRequest.Post(endpoint, data))
        {
            req.method = UnityWebRequest.kHttpVerbPOST;
            req.SetRequestHeader("Authorization", "Basic bXVsdGljaGFpbnJwYzpGQzhCQnI3dUJtamk0OVRoZVE5TkU3cmRGYVZtYXVaaEdRelNqeWpVRWhpWQ==");
            req.SetRequestHeader("Content-Type", "application/json");
            req.SetRequestHeader("Accept", "application/json");
            yield return req.SendWebRequest();
            if (req.isNetworkError || req.isHttpError) Debug.Log(req.error);

            Debug.Log("Response as byte:"+ req.downloadHandler.data);
            Debug.Log("Response as string:"+ req.downloadHandler.text);
        }
    }

    public IEnumerator buy(System.Action<string> result)
    {
        Debug.Log("Buy Enumerator was clicked");
        Hashtable postHeader = new Hashtable();
        
        postHeader.Add("Authorization", "Basic bXVsdGljaGFpbnJwYzpGQzhCQnI3dUJtamk0OVRoZVE5TkU3cmRGYVZtYXVaaEdRelNqeWpVRWhpWQ==");
        postHeader.Add("Content-Type", "application/json");
    

        string jsonStr = "{\"method\":\"sendassetfrom\",\"params\":[\"14YzXsRpFFzbqDbiyMNnHpZVhUszVdc3YhD5Pr\",\"1UppndQL8gKuTRSiwAiTLkvRWMGTt3rWdmiuXB\",\"xdncoin\",199,0,\"{\"payment info\":\"from rodel to goleng\"}\"],\"id\":\"63219905-1563605760\",\"chain_name\":\"dlt_xdn\"} ";
        jsonStr = "{\"method\":\"sendassetfrom\",\"params\":[\"14YzXsRpFFzbqDbiyMNnHpZVhUszVdc3YhD5Pr\",\"1UppndQL8gKuTRSiwAiTLkvRWMGTt3rWdmiuXB\",\"xdncoin\",199\"],\"id\":\"63219905-1563605760\",\"chain_name\":\"dlt_xdn\"}";
        Debug.Log("Json Submitted str:  " + jsonStr);
        var formData = System.Text.Encoding.UTF8.GetBytes(jsonStr);
        
        WWW www = new WWW(endpoint, formData, postHeader);

        Debug.Log("WWW BUY: " + endpoint );
        Debug.Log("form buy: " + formData);
        yield return www;

        elapsedTime = 0.0f;

        while (!www.isDone)
        {
            elapsedTime += Time.deltaTime;
            if (elapsedTime >= TIME_OUT)
            {
                break;
            }
            yield return null;
        }

        if (!www.isDone)
        {
            Debug.Log("Connection Failed");
            result(null);
            yield break;
        }

        if (www.error == null)
        {
            Debug.Log("Buy Ok!: " + www.text);
            result(www.text);
        }
        else
        {
            Debug.Log("WWW : " + www.text);
          
        }
    }
    public void BuyThis()
    {
        Debug.Log("BuyThis was called");
        StartCoroutine(TaskBuy());
    }

    IEnumerator TaskBuy()
    {
        //yield return StartCoroutine(buy(value => responseToken = value));
        yield return StartCoroutine(PostRequest());
        
    }
}
