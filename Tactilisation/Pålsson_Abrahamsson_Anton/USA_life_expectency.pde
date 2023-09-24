/*MY COMMMENT:
Hello. This source code has comments regarding my own additions.
Please note that most comments are not my own.
Most are from a template.
I merely wish to express what I have done myself.
My comments will start with "MY COMMMENT:"*/
 
 /**
 **********************************************************************************************************************
 * @file       Haptic_Physics_Template.pde
 * @author     Steve Ding, Colin Gallacher
 * @version    V3.0.0
 * @date       27-September-2018
 * @brief      Base project template for use with pantograph 2-DOF device and 2-D physics engine
 *             creates a blank world ready for creation
 **********************************************************************************************************************
 * @attention
 *
 *
 **********************************************************************************************************************
 */
 
 
 
 /* library imports *****************************************************************************************************/ 
import processing.serial.*;
import static java.util.concurrent.TimeUnit.*;
import java.util.concurrent.*;
/* end library imports *************************************************************************************************/  



/* scheduler definition ************************************************************************************************/ 
private final ScheduledExecutorService scheduler      = Executors.newScheduledThreadPool(1);
/* end scheduler definition ********************************************************************************************/ 



/* device block definitions ********************************************************************************************/
Board             haplyBoard;
Device            widgetOne;
Mechanisms        pantograph;

byte              widgetOneID                         = 3;
int               CW                                  = 0;
int               CCW                                 = 1;
boolean           rendering_force                     = false;
/* end device block definition *****************************************************************************************/



/* framerate definition ************************************************************************************************/
long              baseFrameRate                       = 120;
/* end framerate definition ********************************************************************************************/ 



/* elements definition *************************************************************************************************/

/* Screen and world setup parameters */
float             pixelsPerCentimeter                 = 40.0;

/* generic data for a 2DOF device */
/* joint space */
PVector           angles                              = new PVector(0, 0);
PVector           torques                             = new PVector(0, 0);

/* task space */
PVector           pos_ee                              = new PVector(0, 0);
PVector           f_ee                                = new PVector(0, 0); 

/* World boundaries */
FWorld            world;
float             worldWidth                          = 25.0;  
float             worldHeight                         = 10.0; 

float             edgeTopLeftX                        = 0.0; 
float             edgeTopLeftY                        = 0.0; 
float             edgeBottomRightX                    = worldWidth; 
float             edgeBottomRightY                    = worldHeight;

/* Initialization of virtual tool */
HVirtualCoupling  s;

/* MY COMMMENT:
The following is data from Gapminder regarding life expectancy in the US from 1950 to 1970. 
Note that decimal for years and age have been shifted in order to work with this setup.
For example: 1.95 = 1950 AD and 6.83 = life expectency 68.3 years.
"All" is a different value used for ALL polygon triangles in order to form a triangle, it is not the same as the value for both genders.*/
float[] years = {1.95, 1.96, 1.97};
float[] ExpAll = {6.83,  7.01,  7.09};
float[] ExpM = {6.54 , 6.66 , 6.7};
float[] ExpF = {7.1,  7.33,  7.46};
float[] All = {1};

FPoly myBlob;
FPoly myBlob2;
FPoly myBlob3;

/* end elements definition *********************************************************************************************/



/* setup section *******************************************************************************************************/
void setup(){
  /* put setup code here, run once: */
  
  /* screen size definition */
  size(1000, 400);
  
  
  /* device setup */
  
  /**  
   * The board declaration needs to be changed depending on which USB serial port the Haply board is connected.
   * In the base example, a connection is setup to the first detected serial device, this parameter can be changed
   * to explicitly state the serial port will look like the following for different OS:
   *
   *      windows:      haplyBoard = new Board(this, "COM10", 0);
   *      linux:        haplyBoard = new Board(this, "/dev/ttyUSB0", 0);
   *      mac:          haplyBoard = new Board(this, "/dev/cu.usbmodem1411", 0);
   */
  haplyBoard          = new Board(this, Serial.list()[0], 0);
  widgetOne           = new Device(widgetOneID, haplyBoard);
  pantograph          = new Pantograph();
  
  println(Serial.list());
  
  widgetOne.set_mechanism(pantograph);
  
  widgetOne.add_actuator(1, CW, 1);
  widgetOne.add_actuator(2, CW, 2);
 
  widgetOne.add_encoder(1, CW, 180, 13824, 1);
  widgetOne.add_encoder(2, CW, 0, 13824, 2);
  
  widgetOne.device_set_parameters();
  
  
  /* 2D physics scaling and world creation */
  hAPI_Fisica.init(this); 
  hAPI_Fisica.setScale(pixelsPerCentimeter); 
  world               = new FWorld();
  
  /* MY COMMMENT:
  Polys setup */
  /*MY COMMMENT:
  Note that years and the base are the same for all triangles, no extra code required.
  However, these depict values for 1950 by default, change from [0] to [1] or [2] for 1960 and 1970.*/
  float numberone = years[0];
  float EXPALL = ExpAll [0];
  float Male = ExpM [0];
  float Female = ExpF [0];
  float Base = All [0];

  /*MY COMMMENT:
  This creates triangles for all, male and female. differences set location*/
  FPoly myBlob = new FPoly();
myBlob.vertex(numberone, -3.2);
myBlob.vertex(EXPALL, 2);
myBlob.vertex(Base,2);
myBlob.setStatic (true);
myBlob.setPosition (worldWidth/1.55, worldHeight/2);
myBlob.setFill(102, 0, 153);
myBlob.setFriction (0);

world.add(myBlob);

  FPoly myBlob2 = new FPoly();
myBlob2.vertex(numberone, -3.2);
myBlob2.vertex(Male, 2);
myBlob2.vertex(Base, 2);
myBlob2.setPosition (worldWidth/5.65, worldHeight/2);
myBlob2.setStatic(true);
myBlob2.setFill(51, 180, 255);
myBlob2.setFriction (20);

world.add(myBlob2);

  FPoly myBlob3 = new FPoly();
myBlob3.vertex(numberone, -3.2);
myBlob3.vertex(Female, 2);
myBlob3.vertex(Base, 2);
myBlob3.setPosition (worldWidth/2.5, worldHeight/2);
myBlob3.setStatic(true);
myBlob3.setFill(255, 102, 102);
myBlob3.setFriction (80);

world.add(myBlob3);
  
  
  /* Setup the Virtual Coupling Contact Rendering Technique */
  s                   = new HVirtualCoupling((1)); 
  s.h_avatar.setDensity(2); 
  s.h_avatar.setFill(0,200,0);  
  s.init(world, edgeTopLeftX+worldWidth/2, edgeTopLeftY+2); 
  
  /* World conditions setup */
  world.setGravity((0.0), (0.0)); //1000 cm/(s^2)
  world.setEdges((edgeTopLeftX), (edgeTopLeftY), (edgeBottomRightX), (edgeBottomRightY)); 
  world.setEdgesRestitution(.4);
  world.setEdgesFriction(0.5);
   
  
  world.draw();
 
  
  /* setup framerate speed */
  frameRate(baseFrameRate);
  
  
  /* setup simulation thread to run at 1kHz */ 
  SimulationThread st = new SimulationThread();
  scheduler.scheduleAtFixedRate(st, 1, 1, MILLISECONDS);
}



/* draw section ********************************************************************************************************/
void draw(){
  /* put graphical code here, runs repeatedly at defined framerate in setup, else default at 60fps: */
  background(255);
  
  /*MY COMMMENT:
  this adds text. they are not haptic and only shows descriptions*/
  textSize(20);
  text("US Life expectancy, 1950-1970", 50, 50); 
fill(51, 180, 255);
textSize(20);
  text("Blue = Male", 50, 70); 
fill(255, 102, 102);
textSize(20);
  text( "Pink = Female", 50, 90); 
fill(102, 0, 153);
textSize(20);
  text("Purple = All", 50, 110); 
fill(0);

  world.draw(); 
}
/* end draw section ****************************************************************************************************/



/* simulation section **************************************************************************************************/
class SimulationThread implements Runnable{
  
  public void run(){
    /* put haptic simulation code here, runs repeatedly at 1kHz as defined in setup */
    rendering_force = true;
    
    if(haplyBoard.data_available()){
      /* GET END-EFFECTOR STATE (TASK SPACE) */
      widgetOne.device_read_data();
    
      angles.set(widgetOne.get_device_angles()); 
      pos_ee.set(widgetOne.get_device_position(angles.array()));
      pos_ee.set(pos_ee.copy().mult(200));  
    }
    
    s.setToolPosition(edgeTopLeftX+worldWidth/2-(pos_ee).x+2, edgeTopLeftY+(pos_ee).y-7); 
    s.updateCouplingForce();
    f_ee.set(-s.getVCforceX(), s.getVCforceY());
    f_ee.div(20000); //
    
    torques.set(widgetOne.set_device_torques(f_ee.array()));
    widgetOne.device_write_torques();
  
    world.step(1.0f/1000.0f);
  
    rendering_force = false;
  }
}
/* end simulation section **********************************************************************************************/



/* helper functions section, place helper functions here ***************************************************************/

/* end helper functions section ****************************************************************************************/
