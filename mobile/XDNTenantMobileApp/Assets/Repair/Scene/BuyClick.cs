using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class BuyClick : MonoBehaviour
{
    APIServices api;

    void Start()
    {
        api = new APIServices();
        //api.AddComponent();
    }

    public void BuyThis()
    {
        Debug.Log("BuyThis was called");
        //StartCoroutine(api.buy(callBackFunction));
    }

    

}
