using UnityEngine;
using System.Collections;

/// MouseLook rotates the transform based on the mouse delta.
/// Minimum and Maximum values can be used to constrain the possible rotation

/// To make an FPS style character:
/// - Create a capsule.
/// - Add the MouseLook script to the capsule.
///   -> Set the mouse look to use LookX. (You want to only turn character but not tilt it)
/// - Add FPSInputController script to the capsule
///   -> A CharacterMotor and a CharacterController component will be automatically added.

/// - Create a camera. Make the camera a child of the capsule. Reset it's transform.
/// - Add a MouseLook script to the camera.
///   -> Set the mouse look to use LookY. (You want the camera to tilt up and down like a head. The character already turns.)
[AddComponentMenu("Camera-Control/Mouse Look")]
public class MouseLook : MonoBehaviour {

	/* ADDED */
	public float rotateSpeed = 10f;
	public int invertPitch = 1;
	public Transform player;
	private float pitch = 0f, yaw = 0f;

	/* ORIGINAL */
	public enum RotationAxes { MouseXAndY = 0, MouseX = 1, MouseY = 2 }
	public RotationAxes axes = RotationAxes.MouseXAndY;
	public float sensitivityX = 15F;
	public float sensitivityY = 15F;

	public float minimumX = -360F;
	public float maximumX = 360F;

	public float minimumY = -60F;
	public float maximumY = 60F;

	float rotationY = 0F;

	void Update ()
	{
#if UNITY_EDITOR
		handleMouseDown ();
#elif UNITY_ANDROID
		handleTouch();
#else
		handleMouseDown ();
#endif
	}

	void touchBegan()
	{
		print ("touch began");
	}

	void touchEnded()
	{
		print ("touch ended");
	}

	void touchMoved()
	{
		//print ("touch moved");
		pitch -= Input.GetTouch (0).deltaPosition.y * rotateSpeed * invertPitch * Time.deltaTime;
		yaw += Input.GetTouch (0).deltaPosition.x * rotateSpeed * invertPitch * Time.deltaTime;

		pitch = Mathf.Clamp (pitch, -80, 80);

		player.eulerAngles = new Vector3 (pitch, yaw, 0f);	
	}

	void touchStationary()
	{
		print ("touch stationary");
	}

	void handleTouch()
	{
		if (Input.touches.Length <= 0) {}
		else 
		{
			for (int i = 0; i < Input.touchCount; i++)
			{
				switch (Input.GetTouch(i).phase)
				{
					case TouchPhase.Began: touchBegan(); break;
					case TouchPhase.Ended: touchEnded(); break;
					case TouchPhase.Moved: touchMoved(); break;
					case TouchPhase.Stationary: touchStationary(); break;
				}
			}
		}
	}

	void handleMouseDown() 
	{
		if (axes == RotationAxes.MouseXAndY)
		{
			float rotationX = transform.localEulerAngles.y + Input.GetAxis("Mouse X") * sensitivityX;
			
			rotationY += Input.GetAxis("Mouse Y") * sensitivityY;
			rotationY = Mathf.Clamp (rotationY, minimumY, maximumY);
			
			transform.localEulerAngles = new Vector3(-rotationY, rotationX, 0);
		}
		else if (axes == RotationAxes.MouseX)
		{
			transform.Rotate(0, Input.GetAxis("Mouse X") * sensitivityX, 0);
		}
		else
		{
			rotationY += Input.GetAxis("Mouse Y") * sensitivityY;
			rotationY = Mathf.Clamp (rotationY, minimumY, maximumY);
			
			transform.localEulerAngles = new Vector3(-rotationY, transform.localEulerAngles.y, 0);
		}
	}

	void Start ()
	{
		// Make the rigid body not change rotation
		if (GetComponent<Rigidbody>())
			GetComponent<Rigidbody>().freezeRotation = true;
	}
	

}